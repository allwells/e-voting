<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // User privileges
        // $superuser_privilege = 'superuser';
        // $admin_privilege = 'admin';
        // $user_privilege = 'user';

        // get user
        $user = auth()->user();

        // // check what role the authenticated user has
        // switch ($user->privilege)
        // {
        //     case $superuser_privilege:
        //         dd("{$user->name} has {$superuser_privilege} privileges");
        //         break;

        //     case $admin_privilege:
        //         dd("{$user->name} has {$admin_privilege} privileges");
        //         break;

        //     case $user_privilege:
        //         dd("{$user->name} has {$user_privilege} privileges");
        //         break;

        //     default:
        //         dd("Who the hell is this??");
        //         break;
        // }

        // return dashboard page
        return view('user.dashboard',
            [
                'user' => $user
            ]
        );
    }
}