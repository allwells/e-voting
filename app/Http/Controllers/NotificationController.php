<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // get all notifications
        $notifications = DB::table('notifications')
            ->where('user_id', Auth::user()->id)
            ->get()->reverse()->values();

        // get notifications that have been read by the user
        $readNotifications = DB::table('notifications')
            ->where('user_id', Auth::user()->id)
            ->where('isRead', true)
            ->get();

        // Get notifications that have not been read
        $unreadNotifications = DB::table('notifications')
            ->where('user_id', Auth::user()->id)
            ->where('isRead', false)
            ->get();

        if(Auth::user()->role !== 'super admin')
        {
            return view('user.notification',
                [
                    'notifications' => $notifications,
                    'readNotifications' => $readNotifications,
                    'unreadNotifications' => $unreadNotifications
                ]
            );
        }

        return view('superuser.notification',
            [
                'notifications' => $notifications,
                'readNotifications' => $readNotifications,
                'unreadNotifications' => $unreadNotifications
            ]
        );
    }

    public function mark(Request $request)
    {
        $userId = Auth::user()->id;
        $notificationId = (int) $request->id;

        $notification = DB::table('notifications')->whereId($notificationId)->where('user_id', $userId)->first();

        if($notification->isRead)
        {
            DB::table('notifications')->whereId($notificationId)->where('user_id', $userId)->update([ 'isRead' => 0 ]);
        }
        else {
            DB::table('notifications')->whereId($notificationId)->where('user_id', $userId)->update([ 'isRead' => 1 ]);
        }

        return back();
    }

    public function markAll()
    {
        DB::table('notifications')->where('user_id', Auth::user()->id)->where('isRead', 0)->update([ 'isRead' => 1 ]);
        return back();
    }

    public function show(Request $request)
    {
        $eventId = (int) $request->id;

        $poll = Poll::whereId($eventId)->first();
        $election = Election::whereId($eventId)->first();

        if($election)
        {
            return \redirect()->route('elections.show', $election->id);
        }
        else if($poll) {
            return \redirect()->route('polls.show', $poll->id);
        }
        else {
            return back()->with('info', 'The event requested has been deleted!');
        }
    }

    public function destroy(Request $request)
    {
        $notificationId = (int) $request->id;
        DB::table('notifications')->whereId($notificationId)->delete();

        return back();
    }
}
