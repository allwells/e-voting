<?php

namespace App\Http\Controllers\Auth;

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
    public function store(Request $request) {

        // validate user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:50',
            'lname' => 'max:50',
            'email' => 'required|email|unique:users|max:120',
            'phone' => 'required|min:10|max:15',
            'dob' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $values = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'password' => \Hash::make($request->password),
            ];

            $query = DB::table('users')->insert($values);

            if($query > 0)
            {
                return response()->json(['status' => 200, 'message' => 'Account created successfully!']);
            }
        }
    }
}
