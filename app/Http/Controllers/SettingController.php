<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function theme(Request $request)
    {
        if($request->theme != 'dark' && $request->theme != 'light') {
            return response()->json(['status' => 422, 'error' => 'Invalid theme!']);
        }

        User::where('id', auth()->user()->id)->update([
            'theme' => $request->theme
        ]);

        return back();
    }

    public function change_email(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        $email_exits = User::where('email', $request->email)->get();

        if($email_exits->count() > 0) {
            return response()->json(['status' => 409, 'error' => 'Email already exits!']);
        }

        if(!$validator->passes())
        {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        }

        User::where('id', auth()->user()->id)->update([
            'email' => $request->email
        ]);

        return back();
    }

    public function change_password(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6|max:18',
        ]);

        if(!$validator->passes())
        {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        }

        if(!(\Hash::make($request->password) == auth()->user()->password))
        {
            return response()->json(['status' => 422, 'error' => 'Invalid password!']);
        }

        // dd($request->password);
        User::where('id', auth()->user()->id)->update([
            'password' => \Hash::make($request->password),
        ]);

        return back();
    }
}
