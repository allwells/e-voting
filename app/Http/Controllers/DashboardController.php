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

        return view('user.dashboard',
            [
                'user' => $user,
                'users' => $users,
                'admins' => $admins,
                'elections' => $elections,
            ]
        );
    }
}