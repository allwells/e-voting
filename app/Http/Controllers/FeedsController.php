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
        $user = auth()->user();
        $votes = Vote::all();
        $candidates = Candidate::all();
        $elections = Election::where('type', 'public')->get()->reverse();

        if(auth()->user()->privilege != 'superuser')
        {
            return view('user.feeds', [
                'count' => $count,
                'user' => $user,
                'votes' => $votes,
                'elections' => $elections,
                'candidates' => $candidates,
            ]);
        }

        return view('dashboard', [
            'count' => $count,
            'user' => $user,
            'votes' => $votes,
            'elections' => $elections,
            'candidates' => $candidates,
        ]);
    }
}
