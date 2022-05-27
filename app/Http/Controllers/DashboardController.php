<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Get page that user should see after logging or when user goes to '/dashboard' route.
     *
     * @return string, array<object>
     */
    public function index()
    {
        // get logged in user
        $user = auth()->user();
        $users = DB::table('users')->get();
        $elections = DB::table('elections')->get();
        $admins = DB::table('users')->where('privilege', '=', 'admin');
        $upcoming_elections = DB::table('elections')->where('status', '=', '');
        $opened_elections = DB::table('elections')->where('status', '=', 'open');
        $closed_elections = DB::table('elections')->where('status', '=', 'closed');

        return view('user.dashboard',
            [
                'user' => $user,
                'users' => $users,
                'admins' => $admins,
                'elections' => $elections,
                'upcoming_elections' => $upcoming_elections,
                'opened_elections' => $opened_elections,
                'closed_elections' => $closed_elections,
            ]
        );
    }
}