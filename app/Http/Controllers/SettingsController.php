<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Get the page the user should see when the user goes to the '/settings' route.
     *
     * @return (string, array<object>)
     */
    public function index()
    {
        $user = auth()->user();

        return view('user.settings',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update theme('mode' column) in database.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store_theme(Request $request)
    {
        // Update theme for logged in user
        User::where('id', auth()->user()->id)->update([
            'mode' => $request->input('theme'),
        ]);

        return back();
    }

    /**
     * Update theme('mode' column) in database.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store_email(Request $request)
    {
        dd($request->email);
        // // Update user email
        // User::where('id', auth()->user()->id)->update([
        //     'email' => $request->email,
        // ]);

        // return back();
    }
}