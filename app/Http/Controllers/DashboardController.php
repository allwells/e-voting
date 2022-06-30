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
        $totalAdmins = User::where('privilege', 'admin')->get();
        $users = User::where('privilege', 'user')->take(7)->get();
        $admins = User::where('privilege', 'admin')->take(7)->get();
        $totalUsers = User::where('privilege','!=', 'superuser')->get();

        $elections = Election::all();
        $electionList = Election::orderBy('start_date')->paginate(25);
        $todayMinusOneWeekAgo = \Carbon\Carbon::today()->subDays(7);
        $latestElection = Election::where('created_at', '>=', $todayMinusOneWeekAgo)->latest()->take(5)->get();

        $userDashboard = 'dashboard';
        $superuserDashboard = 'superuser.dashboard';
        $superuser = auth()->user()->privilege === 'superuser';

        return view((!$superuser ? $userDashboard : $superuserDashboard), [
            'users' => $users,
            'admins' => $admins,
            'elections' => $elections,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'electionList' => $electionList,
            'latestElection' => $latestElection,
        ]);
    }
}
