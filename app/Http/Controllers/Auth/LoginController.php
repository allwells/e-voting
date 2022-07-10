<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Get the page the user should see when the user goes to the '/login' route.
     *
     * @return string
     */
    public function index()
    {
        return view('auth.login');
    }


    /**
     * Validate the user input and authenticate the user.
     * Get the path the path the user should be redirected to after a successful login.
     *
     * @param  Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        // validate user input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
            ]
        );

        /**
         * Authenticate user and @return error message if authentication fails.
         */
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('error', 'Invalid email or password!');
        }

        // redirect user to intended page
        return redirect()->intended('');
    }
}
