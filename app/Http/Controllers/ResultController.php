<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vote;
use App\Models\Election;
use Jorenvh\Share\Share;
use App\Models\Candidate;
use App\Models\Participant;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $closedPublicElections = Election::where('type', 'public')->where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get();
        $closedPrivateElections = Election::where('type', 'private')->where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get();
        $participants = Participant::where('user_id', auth()->user()->id)->get();
        $elections = collect();

        foreach($closedPrivateElections as $closedPrivateElection)
        {
            $electionId = $participants->pluck('election_id')->toArray();
            if(in_array($closedPrivateElection->id , $electionId))
            {
                $elections->push($closedPrivateElection);
            }
        }

        foreach($closedPublicElections as $closedPublicElection)
        {
            $elections->push($closedPublicElection);
        }


        if(auth()->user()->privilege !== 'superuser' && auth()->user()->privilege !== 'admin')
        {
            return view('result', [
                'elections' => $elections,
            ]);
        } else {
            return view('result', [
                'elections' => Election::where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get(),
            ]);
        }
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

        return view('show_results', [
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
