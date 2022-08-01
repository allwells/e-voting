<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;

class FeedsController extends Controller
{
    public function index()
    {
        $count = 0;
        $votes = Vote::all();
        $candidates = Candidate::all();
        $elections = Election::where('type', 'public')->get();

        return view('user.feeds', [
            'count' => $count,
            'votes' => $votes,
            'elections' => $elections,
            'candidates' => $candidates,
        ]);
    }
}
