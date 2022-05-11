<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // get authenticated user
        $user = auth()->user();

        // return profile page
        return view('user.profile',
            [
                'user' => $user,
            ]
        );
    }
}