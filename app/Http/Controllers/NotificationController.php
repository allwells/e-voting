<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // get all notifications
        $notifications = \DB::table('notifications')
            ->where('user_id', auth()->user()->id)
            ->get()->reverse()->values();

        // get notifications that have been read by the user
        $readNotifications = \DB::table('notifications')
            ->where('user_id', auth()->user()->id)
            ->where('isRead', true)
            ->get();

        // Get notifications that have not been read
        $unreadNotifications = \DB::table('notifications')
            ->where('user_id', auth()->user()->id)
            ->where('isRead', false)
            ->get();

        if(auth()->user()->privilege != 'superuser')
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

    public function markAsRead(Request $request)
    {
        \DB::table('notifications')->where('user_id', auth()->user()->id)->where('isRead', 0)->update([ 'isRead' => 1 ]);
        return back();
    }

    public function markAsUnRead(Request $request)
    {
        \DB::table('notifications')->where('user_id', auth()->user()->id)->where('isRead', 1)->update([ 'isRead' => 0 ]);
        return back();
    }
}
