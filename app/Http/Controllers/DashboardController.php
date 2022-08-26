<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $today = \Carbon\Carbon::now();
        $today = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $totalElections = Election::all();
        $elections = Election::all()->take(5);
        $totalAdmins = User::where('privilege', 'admin')->get();
        $totalUsers = User::where('privilege','!=', 'superuser')->get();
        $users = User::where('privilege','!=', 'superuser')->take(5)->get();

        $results = collect();

        foreach($totalElections as $election)
        {
            $hasEnded = ($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed';
            if($hasEnded)
            {
                $results->push($election);
            }
        }

        if(auth()->user()->privilege != 'superuser')
        {
            return back()->with('error', 'Error: The page requested was not found!');
        }

        return view('superuser.dashboard', [
            'users' => $users,
            'today' => $today,
            'elections' => $elections,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'results' => $results->take(5),
            'totalElections' => $totalElections,
        ]);
    }
}
