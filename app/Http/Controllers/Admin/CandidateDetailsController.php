<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CandidateDetailsController extends Controller
{
    public function index()
    {

        $candidates = Candidate::all();
        $votes = Vote::all();


        return view('admin.candidates', [
            'candidates' => $candidates,
            'votes' => $votes,
        ]);
    }
}
