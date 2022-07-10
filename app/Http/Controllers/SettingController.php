<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function profileSetting()
    {
        return view('settings.edit_profile');
    }

    public function emailSetting()
    {
        return view('settings.change_email');
    }

    public function passwordSetting()
    {
        return view('settings.change_password');
    }

    public function notificationSetting()
    {
        return view('settings.notification');
    }

    public function theme(Request $request)
    {
        if($request->theme != 'dark' && $request->theme != 'light') {
            return back()->with('error', 'Oops! Invalid theme.');
        }

        User::where('id', auth()->user()->id)->update([ 'theme' => $request->theme ]);

        return back()->with('success', 'Theme updated!');
    }

    public function editProfile(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'phone' => 'required|min:10|max:16',
        ]);

        if(!$validator->passes())
        {
            return back()->with('warn', 'Read the message under each input field and try again.');
        }

        User::where('id', auth()->user()->id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profile updated!');
    }

    public function changeEmail(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if(!$validator->passes())
        {
            return back()->with('warn', 'Read the message under each input field and try again.');
        }

        $email = $request->email;
        $confirmEmail = $request->email_confirmation;

        if($email != $confirmEmail)
        {
            return back()->with('error', 'Emails do not match!');
        }

        $emailExits = User::where('email', $request->email)->get();

        if($emailExits->count() > 0) {
            return back()->with('error', 'User with this email already exits!');
        }

        User::where('id', auth()->user()->id)->update([ 'email' => $request->email ]);

        return back()->with('success', 'Email updated successfully!');
    }

    public function changePassword(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6'
        ]);

        if(!$validator->passes())
        {
            return back()->with('warn', 'You have not met all password requirements!');
        }

        $currentPassword = $request->current_password;
        $newPassword = $request->password;
        $confirmNewPassword = $request->password_confirmation;

        if(!(\Hash::check($currentPassword, auth()->user()->password)))
        {
            return back()->with('error', 'The password you entered is incorrect!');
        }

        if(!($newPassword == $confirmNewPassword))
        {
            return back()->with('warn', 'Password mismatch: See \'New Password\' and \'Confirm Password\' fields.');
        }

        User::where('id', auth()->user()->id)->update([ 'password' => \Hash::make($newPassword) ]);

        return back()->with('success', 'Your password has been updated!');
    }

    public function setNotification(Request $request)
    {
        if($request->email_notification == null)
        {
            User::where('id', auth()->user()->id)->update([ 'email_notifications' => 'off' ]);
            return back()->with('success', 'You have successfully unsubscribed from email notifications.');
        }

        if($request->email_notification == 'on')
        {
            User::where('id', auth()->user()->id)->update([ 'email_notifications' => $request->email_notification ]);
            return back()->with('success', 'You have successfully subscribed to email notifications.');
        }

        return back()->with('error', 'Oops! Something went wrong.');
    }
}
