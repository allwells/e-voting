<?php

namespace App\Http\Controllers\User;

use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VotingAreaController extends Controller
{
    public function index()
    {
        $votes = Vote::all();
        $elections = DB::table('elections');
        $candidates = Candidate::all();

        return view('user.voting',[
            'votes' => $votes,
            'elections' => $elections,
            'candidates' => $candidates,
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
