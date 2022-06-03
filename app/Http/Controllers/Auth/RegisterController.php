<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(Request $request) {

        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|email|unique:users|max:120',
            'password' => 'required|confirmed|min:6|max:18',
        ]);


        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $values = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
            ];

            $query = DB::table('users')->insert($values);

            if($query > 0)
            {
                // authenticate user and signs user in
                auth()->attempt($request->only('email', 'password'));
                return response()->json(['status' => 200, 'message' => 'Account created succefully!']);
            }
        }
    }
}
