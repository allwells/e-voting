<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) {
        // validation
        $this->validate($request, [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email|max:120',
            'password' => 'required|confirmed',
            ]
        );

        // store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]
        );

        // authenticate user and sign user in
        auth()->attempt($request->only('email', 'password'));

        // redirect user
        return redirect()->route('dashboard');

    }
}