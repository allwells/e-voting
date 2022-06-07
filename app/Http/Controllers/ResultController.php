<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $elections = Election::all();

        return view('result', [
            'elections' => $elections
        ]);
    }

    public function show(Request $request)
    {
        $votes = Vote::all();
        $elections = Election::whereId((int) $request->election)->first();
        $candidates = Candidate::where('election_id', (int) $request->election)->get();
        $hasVoted = Vote::where('user_id', auth()->user()->id)->where('election_id', $elections->id)->first();

        return view('show_results', [
            'votes' => $votes,
            'election' => $elections,
            'candidates' => $candidates,
        ]);
    }

    public function result_chart(Request $request)
    {
        $candidates = Candidate::where('election_id', (int) $request->election)->get();
        $labels = [];
        $count = [];

        foreach ($candidates as $candidate){
            array_push($labels, $candidate->name);
        }

        $values = Candidate::with('votes')->where('election_id', (int) $request->election)->get();

        foreach ($values as $item) {
            array_push($count, $item->votes->count());
        }

        $election = Election::whereId((int) $request->election)->first();

        $chart = Chartisan::build()->labels($labels)->dataset($election->title, $count)->toJSON();
        dd($chart);
        // return $chart;
    }
}
