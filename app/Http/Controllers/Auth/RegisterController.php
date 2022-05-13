<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    /**
     * Get the page te user should see when the user goes to the '/register' route
     *
     * @return string
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Validates user inputs and stores user in database and signs user in
     *
     * @param  Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request) {
        // validate user input
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email|max:120',
            'password' => 'required|confirmed',
            ]
        );

        // store user in database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]
        );

        // authenticate user and signs user in
        auth()->attempt($request->only('email', 'password'));

        // redirect user
        return redirect()->route('dashboard');

    }
}