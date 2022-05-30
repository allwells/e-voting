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
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        // get logged in user
        $user = auth()->user();
        $users = DB::table('users')->get();
        $elections = DB::table('elections')->get();
        $admins = DB::table('users')->where('privilege', '=', 'admin')->get();
        $upcoming = DB::table('elections')->where('status', '=', '')->where('start_date', '>', $today)->where('end_date', '>', $today)->get();
        $opened = DB::table('elections')->where('status', '=', 'open')->where('start_date', '<', $today)->where('end_date', '>', $today)->get();
        $closed = DB::table('elections')->where('start_date', '<', $today)->where('end_date', '<', $today)->orWhere('status', '=', 'closed')->get();

        // get just 2 items from the returned data
        $upcoming_elections = DB::table('elections')->where('status', '=', '')->orderBy('start_date')->take(2)->get();
        $opened_elections = DB::table('elections')->where('status', '=', 'open')->orderBy('start_date')->take(2)->get();


        return view('user.dashboard',
            [
                'user' => $user,
                'today' => $today,
                'users' => $users,
                'admins' => $admins,
                'opened' => $opened,
                'closed' => $closed,
                'upcoming' => $upcoming,
                'elections' => $elections,
                'opened_elections' => $opened_elections,
                'upcoming_elections' => $upcoming_elections,
            ]
        );
    }
}
