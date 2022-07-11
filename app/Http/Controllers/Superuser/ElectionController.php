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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

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

        foreach($privateElections as $privateElection)
        {
            $electionId = $participants->pluck('election_id')->toArray();
            if(in_array($privateElection->id , $electionId))
            {
                $elections->push($privateElection);
            }
        }

        foreach($publicElections as $publicElection)
        {
            $elections->push($publicElection);
        }

        return view('superuser.elections', [
            'today' => $today,
            'electionList' => $elections,
            'elections' => Election::all(),
            'latestElection' => $latestElection,
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
        return view('superuser.create_election');
    }

    public function create(Request $request, Election $election)
    {
        // get user privilege
        $isUnauthorizedUser = (auth() && auth()->user()->privilege !== 'superuser') && (auth() && auth()->user()->privilege !== 'admin');

        if($isUnauthorizedUser)
        {
            return redirect()->route('dashboard')->with('error', 'You do not have access to such actions.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'max:300',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Oop! Something\'s not right. Check your inputs and try again.');
        } else {
            $accessCode = Str::random(10);

            $election_values = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'accessCode' => $accessCode,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            $query = DB::table('elections')->insert($election_values);

            $electionId = Election::where('created_at', $election_values['created_at'])->where('updated_at', $election_values['updated_at'])->get();

            foreach($request->name as $key => $candidate_name) {
                $candidate = new Candidate;

                $candidate->election_id = $electionId[0]->id;
                $candidate->name = $candidate_name;
                $candidate->party = $request->party[$key];
                $candidate->save();
            }

            if($query > 0)
            {
                return back()->with('success', 'Election created!');
            }
        }

        return back()->with('error', 'Oops! There was an error.');
    }

    public function show(Request $request, Election $election)
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $votes = Vote::all();
        $elections = Election::whereId($election->id)->first();
        $candidates = Candidate::where('election_id', $election->id)->get();
        $voted = Vote::where('user_id', auth()->user()->id)->where('election_id', $elections->id)->first();
        $participants = Participant::where('election_id', $election->id)->get();

        return view('show_elections', [
            'votes' => $votes,
            'today' => $today,
            'voted' => $voted,
            'election' => $elections,
            'candidates' => $candidates,
            'participants' => $participants,
        ]);
    }

    public function vote(Request $request)
    {
        Vote::create([
            'user_id' => $request->user()->id,
            'election_id' => (int) $request->election,
            'candidate_id' => (int) $request->candidate,
        ]);

        return back()->with('info', 'Thank you for participating.');
    }

    public function close(Election $election)
    {
        Election::where('id', $election->id)->update([
            'status' => 'closed',
        ]);

        return back()->with('success', 'Election closed!');
    }

    public function showEdit(Election $election)
    {
        return view('superuser.edit_election', [
            'election' => $election,
            'candidates' => Candidate::where('election_id', $election->id)->get()
        ]);
    }

    public function edit(Request $request, Election $election)
    {
        // get user privilege
        $isUnauthorizedUser = (auth() && auth()->user()->privilege !== 'superuser') && (auth() && auth()->user()->privilege !== 'admin');

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
            $election_values = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            Election::where('id', $election->id)->update($election_values);

            foreach($request->name as $key => $candidate_name) {
                $exists = Candidate::where('election_id', $election->id)->where('name', $candidate_name)->where('party', $request->party[$key])->get();

                if($exists->count() > 0)
                {
                    Candidate::where('election_id', $election->id)->update([
                        'name' => $candidate_name,
                        'party' => $request->party[$key]
                    ]);
                } else {
                    Candidate::create([
                        'election_id' => $election->id,
                        'name' => $candidate_name,
                        'party' => $request->party[$key]
                    ]);
                }
            }
        }

        return back();
    }

    public function fileImport(Request $request, Election $election)
    {
        $extension = $request->file('imported_file')->getClientOriginalExtension();

        if($extension !== 'csv' && $extension != 'xls' && $extension != 'xlsx')
        {
            return back()->with('error', 'Invalid file format! Preferred file format: .csv, .xls or .xlsx');
        }

        $path = storage_path('app') . '/' . $request->file('imported_file')->store('temp');
        $uploadedData = Excel::toArray(new FileImport, $path);

        foreach($uploadedData[0] as $users)
        {
            $user = new User();
            $user->fname = $users['fname'];
            $user->lname = $users['lname'];
            $user->email = $users['email'];
            $user->phone = $users['phone'];
            $user->password = Hash::make($users['email']);
            $user->save();

            $userId = $user->id;

            $newParticipant = [
                'user_id' => $userId,
                'election_id' => $election->id,
                'name' => $users['fname'] . " " . $users['lname'],
                'email' => $users['email'],
            ];

            Participant::create($newParticipant);

            $recipient = $users['email'];

            $mailData = [
                'recipient' => $users,
                'from' => config('mail.from.address'),
                'name' => config('app.name'),
                'subject' => "Private Election Invitation",
                'election' => $election,
            ];

            Mail::send('mail.invitation', $mailData, function($message) use ($mailData, $recipient) {
                $message->to($recipient)
                        ->from($mailData['from'], $mailData['name'])
                        ->subject($mailData['subject']);
            });
        }

        return back()->with('success', 'Data imported!');
    }

    public function destroy(Election $election)
    {
        $isUnauthorizedUser = (auth() && auth()->user()->privilege !== 'superuser') && (auth() && auth()->user()->privilege !== 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $election->delete();

        return back()->with('success', 'Election deleted!');
    }
}
