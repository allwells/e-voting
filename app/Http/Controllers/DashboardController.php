<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $admins = DB::table('users')->where('privilege', '=', 'admin')->get();
        $upcoming_elections = DB::table('elections')->where('status', '=', '')->paginate(3);
        $opened_elections = DB::table('elections')->where('status', '=', 'open')->paginate(3);
        $closed_elections = DB::table('elections')->where('status', '=', 'closed')->paginate(3);

        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        return view('user.dashboard',
            [
                'user' => $user,
                'users' => $users,
                'admins' => $admins,
                'elections' => $elections,
                'upcoming_elections' => $upcoming_elections,
                'opened_elections' => $opened_elections,
                'closed_elections' => $closed_elections,
                'today' => $today,
            ]
        );
    }
}
