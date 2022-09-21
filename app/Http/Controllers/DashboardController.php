<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poll;
use App\Models\User;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $elections = Election::all();

        foreach($elections as $election)
        {
            $diffInDate = Carbon::parse($today)->diffInHours($election->start_date);

            if($diffInDate === 1)
            {
                $superusers = User::where('privilege', 'superuser')->get();
                $ownerOfPost = User::where('id', $election->user_id)->first();

                foreach($superusers as $superuser)
                {

                    $notificationExists = DB::table('notifications')->where('user_id', $superuser->id)->where('event_id', $election->id)->first();

                    if(!$notificationExists)
                    {
                        DB::table('notifications')->insert([
                            'user_id' => $superuser->id,
                            'event_id' => $election->id,
                            'message' => 'Election: <strong>' . $election->title . '</strong> created by <strong>'. ($ownerOfPost ? "$ownerOfPost->fname $ownerOfPost->lname" : "Deleted User") . '</strong> begins in 1 hour.',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
        }

        $totalElections = Election::all();
        $elections = Election::all()->take(5);
        $totalAdmins = User::where('privilege', 'admin')->get();
        $totalUsers = User::where('privilege','!=', 'superuser')->get();
        $users = User::where('privilege','!=', 'superuser')->take(5)->get();
        $polls = Poll::all()->take(5);

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
            'polls' => $polls,
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