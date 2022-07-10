<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
    public function store(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:50',
            'lname' => 'max:50',
            'email' => 'required|email|unique:users|max:100',
            'dob' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Oops! There\'s a problem. Check your inputs and try again.');
        } else {
            $values = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'dob' => $request->dob,
                'password' => \Hash::make($request->password),
            ];

            User::create($values);

            // authenticate user and sign user in
            auth()->attempt($request->only('email', 'password'));

            // redirect user
            return redirect()->route('dashboard');
        }
    }
}
