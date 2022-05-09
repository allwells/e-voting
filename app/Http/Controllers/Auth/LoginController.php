<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller {

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
            ]
        );

        // authenticate user and sign user in
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid email or password!');
        }

        // redirect user to dashboard
        return redirect()->route('dashboard');
    }
}