<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $query = User::where('id', auth()->user()->id)->update([
            'mode' => $request->input('theme'),
        ]);

        if($query)
        {
            response()->json(['status' => 200, 'message' => 'Theme updated succefully!']);
            return back();
        }

    }

    /**
     * Update user email in database.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store_email(Request $request)
    {
        // Update user email
        $emailExists = DB::table('users')->where('email', '=', $request->email)->get();

        if($emailExists->count() > 0) {
            return response()->json(['status' => 409, 'error' => 'Email already exists!']);
        }

        $query = User::where('id', auth()->user()->id)->update([
            'email' => $request->email,
        ]);

        if($query === 1)
        {
            return response()->json(['status' => 200, 'message' => 'Email updated succefully!']);
        }
    }
}
