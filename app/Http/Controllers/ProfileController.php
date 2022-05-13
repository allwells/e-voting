<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Get the page the user should see when the user goes to the '/profile' route.
     *
     * @return string, array<object>
     */
    public function index()
    {
        // Get authenticated user.
        $user = auth()->user();

        // return profile page
        return view('user.profile',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update user details in the databae with user inputs given.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store(Request $request)
    {
        // Update user
        User::where('id', auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $this->purify($request->phone),
            'dob' => $request->dob,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'city' => $request->city,
            'code' => $request->code,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        return back();
    }

    /**
     * Remove unwanted characters from phone number string.
     *
     * @param  string  $phone
     * @return string
     */
    protected function purify($phone)
    {
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);

        return $phone;
    }
}