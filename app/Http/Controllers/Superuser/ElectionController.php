<?php

namespace App\Http\Controllers\Superuser;

use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use App\Imports\FileImport;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Snowfire\Beautymail\Beautymail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Cloudinary\Configuration\Configuration;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ElectionController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);
        $todayMinusOneWeek = \Carbon\Carbon::today()->subDays(7);

        $elections = collect();

        $publicElections = Election::where('type', 'public')->orderBy('start_date')->get();
        $privateElections = Election::where('type', 'private')->orderBy('start_date')->get();
        $latestElection = Election::where('created_at', '>=', $todayMinusOneWeek)->latest()->take(5)->get();
        $participants = Participant::where('user_id', auth()->user()->id)->get();
        $votes = Vote::where('user_id', auth()->user()->id)->get();

        foreach($privateElections as $privateElection)
        {
            $electionIds = $participants->pluck('election_id')->toArray();
            if(in_array($privateElection->id , $electionIds))
            {
                $elections->push($privateElection);
            }
        }

        foreach($publicElections as $publicElection)
        {
            $electionIds = $votes->pluck('election_id')->toArray();
            if(in_array($publicElection->id , $electionIds))
            {
                $elections->push($publicElection);
            }
        }

        if(auth()->user()->privilege != 'superuser')
        {
            return view('user.elections', [
                'elections' => $elections,
            ]);
        }

        return view('superuser.elections', [
            'today' => $today,
            'elections' => Election::all(),
        ]);
    }

    public function codeVerification(Request $request)
    {
        $election = Election::where('accessCode', $request->code)->first();

        if($election)
        {
            $isActive = $election->codeStatus == 'active';

            if($isActive)
            {
                $participant = [
                    'user_id' => auth()->user()->id,
                    'election_id' => $election->id,
                    'name' => auth()->user()->fname . " " . auth()->user()->lname,
                    'email' => auth()->user()->email,
                ];

                $participantExists = Participant::where('user_id', auth()->user()->id)->where('election_id',  $election->id)->first();

                if($participantExists)
                {
                    return redirect()->route('elections.show', $election->id)->with('error', 'You are already a participant in this election!');
                }

                Participant::create($participant);

                return redirect()->route('elections.show', $election->id)->with('success', 'Code verified successfully! You can now participate in this election.');
            }
        }

        return back()->with('error', 'The code you entered is not valid!');
    }

    public function codeActivation(Request $request, Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if($election->type == 'private' && $election->codeStatus == 'active')
        {
            Election::where('id', $election->id)->update([ 'codeStatus' => 'inactive' ]);
            return back()->with('success', 'Code deactivated successfully!');
        }

        if($election->type == 'private' && $election->codeStatus == 'inactive')
        {
            Election::where('id', $election->id)->update([ 'codeStatus' => 'active' ]);
            return back()->with('success', 'Code activated successfully!');
        }

        return back()->with('error', 'Oops! There was an error.');
    }

    public function showCreate()
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if(auth()->user()->privilege == 'admin')
        {
            return view('user.create_election');
        } else {
            return view('superuser.create_election');
        }
    }

    public function sendInviteManually(Request $request, Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $genPassword = Str()->random(32);
        $passwordHash = Hash::make($genPassword);

        $userExists = User::where('email', $request->email)->first();
        $userId = null;

        if(!$userExists)
        {
            $user = new User();
            $user->fname = $request->fname;
            $user->lname = $request->lname ? $request->lname : null;
            $user->email = $request->email;
            $user->password = $passwordHash;
            $user->save();
            $userId = $user->id;
        }

        $preferredUserId = $userExists ? $userExists->id : $userId;

        $newParticipant = [
            'user_id' => $preferredUserId,
            'election_id' => $election->id,
        ];

        Participant::create($newParticipant);

        if($userExists)
        {
            $newNotification = [
                'user_id' => $preferredUserId,
                'election_id' => $election->id,
                'message' => 'You are invited to participate in a private election titled "' . $election->title . '"',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('notifications')->insert($newNotification);
        }

        if(!$userExists)
        {
            $recipient = $request->email;

            $mailData = [
                'recipient' => ['first_name' => $request->fname, 'email' => $recipient],
                'from' => config('mail.from.address'),
                'name' => config('app.name'),
                'subject' => "Private Election Invitation",
                'election' => $election,
                'genPassword' => $genPassword
            ];

            $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautyMail->send('mail.new_user_invitation', $mailData, function($message) use ($mailData, $recipient)
            {
                $message->to($recipient)
                        ->from($mailData['from'], $mailData['name'])
                        ->subject($mailData['subject']);
            });

        } else {
            $recipient = $userExists->email;

            $mailData = [
                'recipient' => $userExists,
                'from' => config('mail.from.address'),
                'name' => config('app.name'),
                'subject' => "Private Election Invitation",
                'election' => $election
            ];

            $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautyMail->send('mail.existing_user_invitation', $mailData, function($message) use ($mailData, $recipient)
            {
                $message->to($recipient)
                        ->from($mailData['from'], $mailData['name'])
                        ->subject($mailData['subject']);
            });
        }

        return back()->with('success', 'Invite sent successfully!');
    }

    public function fileImport(Request $request, Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $extension = $request->file('imported_file')->getClientOriginalExtension();

        if($extension != 'csv' && $extension != 'xls' && $extension != 'xlsx')
        {
            return back()->with('error', 'Invalid file format! Preferred file format: .csv, .xls or .xlsx');
        }

        $path = storage_path('app') . '/' . $request->file('imported_file')->store('temp');
        $uploadedData = Excel::toArray(new FileImport, $path);

        foreach($uploadedData[0] as $users)
        {
            $genPassword = Str()->random(32);
            $passwordHash = Hash::make($genPassword);

            $userExists = User::where('email', $users['email'])->first();
            $userId = null;

            if(!$userExists)
            {
                $user = new User();
                $user->fname = $users['first_name'];
                $user->lname = $users['last_name'] ? $users['last_name'] : null;
                $user->email = $users['email'];
                $user->password = $passwordHash;
                $user->save();
                $userId = $user->id;
            }

            $preferredUserId = $userExists ? $userExists->id : $userId;

            $newParticipant = [
                'user_id' => $preferredUserId,
                'election_id' => $election->id,
            ];

            Participant::create($newParticipant);

            if($userExists)
            {
                $newNotification = [
                    'user_id' => $preferredUserId,
                    'election_id' => $election->id,
                    'message' => 'You are invited to participate in a private election titled "' . $election->title . '"',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                DB::table('notifications')->insert($newNotification);
            }

            if(!$userExists)
            {
                $recipient = $users['email'];

                $mailData = [
                    'recipient' => $users,
                    'from' => config('mail.from.address'),
                    'name' => config('app.name'),
                    'subject' => "Private Election Invitation",
                    'election' => $election,
                    'genPassword' => $genPassword
                ];

                $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                $beautyMail->send('mail.new_user_invitation', $mailData, function($message) use ($mailData, $recipient)
                {
                    $message->to($recipient)
                            ->from($mailData['from'], $mailData['name'])
                            ->subject($mailData['subject']);
                });

            } else {
                $recipient = $userExists->email;

                $mailData = [
                    'recipient' => $userExists,
                    'from' => config('mail.from.address'),
                    'name' => config('app.name'),
                    'subject' => "Private Election Invitation",
                    'election' => $election
                ];

                $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                $beautyMail->send('mail.existing_user_invitation', $mailData, function($message) use ($mailData, $recipient)
                {
                    $message->to($recipient)
                            ->from($mailData['from'], $mailData['name'])
                            ->subject($mailData['subject']);
                });
            }
        }

        return back()->with('success', 'Invite sent successfully!');
    }

    private function importCandidate(Request $request, Election $election) {

        $extension = $request->file('imported_file')->getClientOriginalExtension();

        if($extension != 'csv' && $extension != 'xls' && $extension != 'xlsx')
        {
            return back()->with('error', 'Invalid file format! Preferred file format: .csv, .xls or .xlsx');
        }

        $path = storage_path('app') . '/' . $request->file('imported_file')->store('temp');
        $uploadedData = Excel::toArray(new FileImport, $path);

        foreach($uploadedData[0] as $candidates)
        {
            if($candidates['candidate_email'])
            {
                $user = User::where('email', $candidates['candidate_email'])->first();

                if($user)
                {
                    $newNotification = [
                        'user_id' => $user->id,
                        'election_id' => $election->id,
                        'message' => 'You have been nominated for this election: "' . $election->title . '"',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    DB::table('notifications')->insert($newNotification);
                }

                $preferredName = $user ? $user->fname : $candidates['candidate_name'];
                $this->notifyCandidates($preferredName, $candidates['candidate_email'], $election);

                $candidate = new Candidate();
                $candidate->election_id = $election->id;
                $candidate->name = $candidates['candidate_name'];
                $candidate->email = $candidates['candidate_email'];
                $candidate->party = $candidates['candidate_party'];
                $candidate->image = $user ? $user->image : null;
                $candidate->save();

            } else {
               return back()->with('info', 'Ensure that all candidates\' email are inputed correctly!');
            }

        }

    }

    private function uploadCandidateImage($filePath)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $options = [ 'folder' => "e-voting/profile-photos" ];
        $path = cloudinary()->upload($filePath, $options)->getSecurePath();

        return $path;
    }

    private function uploadElectionCover($filePath)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $options = [ 'folder' => "e-voting/election-cover-photos" ];
        $path = cloudinary()->upload($filePath, $options)->getSecurePath();

        return $path;
    }

    private function notifyCandidates($firstName, $email, $election)
    {
        $mailData = [
            'recipient' => $firstName,
            'from' => config('mail.from.address'),
            'name' => config('app.name'),
            'subject' => "Nominated for an election",
            'election' => $election
        ];

        $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautyMail->send('mail.nominee', $mailData, function($message) use ($mailData, $email)
        {
            $message->to($email)
                    ->from($mailData['from'], $mailData['name'])
                    ->subject($mailData['subject']);
        });
    }

    public function create(Request $request, Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'max:300',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'cover' => 'mimes:jpeg,svg,png|size:5000',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Oops! Something\'s not right. Check your inputs and try again.');
        } else {
            $accessCode = Str::random(10);
            $electionValues = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'cover' => $request->electionCover ? $this->uploadElectionCover($request->electionCover->getRealPath()) : null,
                    'type' => $request->type != 'private' && $request->type != 'public' ? 'public' : $request->type,
                    'location' => $request->location ? $request->location : null,
                    'accessCode' => $accessCode,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            $query = DB::table('elections')->insert($electionValues);
            $election = Election::where('created_at', $electionValues['created_at'])->where('updated_at', $electionValues['updated_at'])->first();

            // if input is manual then do this
            if($request->name && $request->email)
            {
                foreach($request->name as $key => $candidateName) {
                    $candidate = new Candidate;
                    $candidate->election_id = $election->id;
                    $candidate->name = $candidateName;
                    $candidate->party = array_key_exists($key, $request->party) ? $request->party[$key] : null;
                    $candidate->email = $request->email[$key];
                    $candidate->image = array_key_exists($key, $request->image) ? $this->uploadCandidateImage($request->image[$key]->getRealPath()) : null;
                    $candidate->save();

                    $user = User::where('email', $request->email[$key])->first();

                    if($user)
                    {
                        $newNotification = [
                            'user_id' => $user->id,
                            'election_id' => $election->id,
                            'message' => 'You have been nominated for this election: "' . $election->title . '"',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        DB::table('notifications')->insert($newNotification);
                    }

                    $preferredName = $user ? $user->fname : $candidateName;
                    $this->notifyCandidates($preferredName, $request->email[$key], $election);
                }
            }

            if($request->file('imported_file'))
            {
                $this->importCandidate($request, $election);
            }

            if($query > 0)
            {
                return \redirect()->route('elections.show', $election)->with('success', 'Election created successfully!');
            }
        }

        return back()->with('error', 'Oops! There was an error.');
    }

    public function show(Request $request, Election $election)
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $electionId = $election->id;

        $votes = Vote::where('election_id', $electionId)->get();
        $elections = Election::whereId($electionId)->first();
        $candidates = Candidate::where('election_id', $electionId)->get();
        $participants = Participant::where('election_id', $electionId)->get();

        $hasNotStarted = $today->lt($election->start_date) && $today->lt($election->end_date);
        $hasStarted = $today->gt($election->start_date) && $today->lt($election->end_date);
        $hasEnded = ($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed';

        $allVotes = Vote::where('election_id', $election->id)->get()->pluck('candidate_id')->toArray();
        $winner = array_count_values($allVotes);

        if(auth()->user()->privilege != 'superuser')
        {
            return view('user.show_election', [
                'votes' => $votes,
                'today' => $today,
                'winner' => $winner,
                'hasEnded' => $hasEnded,
                'election' => $elections,
                'hasStarted' => $hasStarted,
                'candidates' => $candidates,
                'participants' => $participants,
                'hasNotStarted' => $hasNotStarted,
            ]);
        }

        return view('superuser.show_election', [
            'votes' => $votes,
            'today' => $today,
            'winner' => $winner,
            'hasEnded' => $hasEnded,
            'election' => $elections,
            'candidates' => $candidates,
            'hasStarted' => $hasStarted,
            'participants' => $participants,
            'hasNotStarted' => $hasNotStarted,
        ]);
    }

    public function addVote(Request $request)
    {
        $userId = auth()->user()->id;
        $electionId = (int) $request->election;
        $candidateId = (int) $request->candidate;

        $voteExists = Vote::where('user_id', $userId)->where('election_id', $electionId)->get();

        if($voteExists->count() === 0)
        {
            Vote::create([
                'user_id' => $userId,
                'election_id' => $electionId,
                'candidate_id' => $candidateId,
            ]);

            return back()->with('info', 'Thank you for participating.');
        } else {
            return back()->with('info', 'You can only vote one candidate. Cancel previous vote to by clicking the vote icon.');
        }
    }

    public function removeVote(Request $request)
    {
        $userId = auth()->user()->id;
        $electionId = (int) $request->election;
        $candidateId = (int) $request->candidate;

        $voteExists = Vote::where('user_id', $userId)->where('election_id', $electionId)->where('candidate_id', $candidateId)->get();

        if($voteExists->count() > 0)
        {
            Vote::where('user_id', $userId)->where('election_id', $electionId)->where('candidate_id', $candidateId)->delete();
            return back()->with('info', 'Your vote has been cancelled.');
        }

        return back()->with('error', 'Oops! There was an error, please try again.');
    }

    public function close(Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        Election::where('id', $election->id)->update([
            'status' => 'closed',
        ]);

        return back()->with('success', 'Election closed!');
    }

    public function showEdit(Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if(auth()->user()->privilege == 'admin')
        {
            return view('user.edit_election', [
                'election' => $election,
                'candidates' => Candidate::where('election_id', $election->id)->get()
            ]);
        } else {
            return view('superuser.edit_election', [
                'election' => $election,
                'candidates' => Candidate::where('election_id', $election->id)->get()
            ]);
        }
    }

    public function edit(Request $request, Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'max:450',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if(!$validator->passes()) {
            return back()->with('error', 'Oops! Something\'s not right. Check your inputs and try again.');
        } else {
            $electionValues = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'location' => $request->location ? $request->location : null,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            Election::where('id', $election->id)->update($electionValues);

            foreach($request->name as $key => $candidateName) {
                $exists = Candidate::where('election_id', $election->id)->where('name', $candidateName)->where('party', $request->party[$key])->get();

                if($exists->count() > 0)
                {
                    Candidate::where('election_id', $election->id)->update([
                        'name' => $candidateName,
                        'party' => $request->party[$key]
                    ]);
                } else {
                    Candidate::create([
                        'election_id' => $election->id,
                        'name' => $candidateName,
                        'party' => $request->party[$key]
                    ]);
                }
            }
        }

        return redirect()->route('elections.show', $election)->with('success', 'Election updated!');
    }

    public function destroy(Election $election)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $election->delete();

        return back()->with('success', 'Election deleted!');
    }
}
