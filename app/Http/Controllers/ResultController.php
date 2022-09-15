<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $closedElections = Election::where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get();
        $votes = Vote::where('user_id', auth()->user()->id)->get();
        $elections = collect();

        foreach($closedElections as $closedElection)
        {
            $electionId = $votes->pluck('election_id')->toArray();
            if(in_array($closedElection->id , $electionId))
            {
                $elections->push($closedElection);
            }
        }

        if(auth()->user()->privilege != 'superuser')
        {
            return view('result', ['elections' => $elections]);
        }

        return view('superuser.result', ['elections' => $closedElections]);
    }

    public function search(Request $request)
    {
        $result = "";
        $elections = Election::where('title', 'Like', '%' . $request->slug . '%')->get();

        foreach($elections as $index => $election)
        {
            $votes = Vote::where('election_id', $election->id)->get();
            $candidates = Candidate::where('election_id', $election->id)->get();

            $result.=
                '<tr class="hover:bg-neutral-50 text-xs">
                    <td class="px-3 text-center cursor-default w-fit">
                        ' . $index + 1 . '
                    </td>

                    <td class="px-2 py-3 text-left">
                        ' . $election->title . '
                    </td>

                    <td class="px-2 py-2 text-left">
                        <div class="line-clamp-1 max-w-5xl w-full">
                            ' . $election->description . '
                        </div>
                    </td>

                    <td class="px-2 py-3 text-left">
                        ' . $candidates->count() . '
                    </td>

                    <td class="px-2 py-3 text-left">
                        ' . $votes->count() . '
                    </td>

                    <td class="px-2 py-2 text-left">
                        <div class="text-[#0000FF] flex justify-center items-center">
                            <a href="' . route('results.view', $election) . '" title="View Results"
                                class="hover:bg-neutral-800/10 rounded-md p-1 focus:bg-neutral-800/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </td>
                 </tr>';
        }

        return response($result);
    }

    // Send email to all participants of this election about the results being out.
    private function sendMail()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $closedElections = Election::where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get();
        $votes = Vote::where('user_id', auth()->user()->id)->get();
        $elections = collect();

        foreach($closedElections as $closedElection)
        {
            $electionId = $votes->pluck('election_id')->toArray();
            if(in_array($closedElection->id , $electionId))
            {
                $elections->push($closedElection);
            }
        }

        $mailData = [
            'recipient' => $users,
            'from' => config('mail.from.address'),
            'name' => config('app.name'),
            'subject' => "Private Election Invitation",
            'election' => $election,
        ];

        $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautyMail->send('mail.election_results', $mailData, function($message) use ($mailData, $recipient)
        {
            $message->to($recipient)
                    ->from($mailData['from'], $mailData['name'])
                    ->subject($mailData['subject']);
        });
    }

    public function show(Request $request)
    {
        $votes = Vote::all();
        $elections = Election::whereId((int) $request->election)->first();
        $candidates = Candidate::where('election_id', (int) $request->election)->get();
        $hasVoted = Vote::where('user_id', auth()->user()->id)->where('election_id', $elections->id)->first();

        $share = \Share::page(
            $request->url(),
            "Results for $elections->title election.",
        )
        ->facebook()
        ->twitter()
        ->telegram()
        ->whatsapp();


        if(auth()->user()->privilege != 'superuser')
        {
            return view('show_results', [
                'votes' => $votes,
                'election' => $elections,
                'candidates' => $candidates,
                'share' => $share
            ]);
        }

        return view('superuser.show_results', [
            'votes' => $votes,
            'election' => $elections,
            'candidates' => $candidates,
            'share' => $share
        ]);
    }

    public function result_chart(Request $request)
    {
        $election = Election::whereId((int) $request->election)->first();
        $candidates = Candidate::where('election_id', (int) $request->election)->get();
        $values = Candidate::with('votes')->where('election_id', (int) $request->election)->get();
        $labels = [];
        $votes = [];

        foreach ($candidates as $candidate){
            array_push($labels, $candidate->name);
        }

        foreach ($values as $item) {
            array_push($votes, $item->votes->count());
        }

        return Chartisan::build()->labels($labels)->dataset("Votes", $votes)->toJSON();
    }
}