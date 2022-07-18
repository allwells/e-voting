<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class PasswordReset extends Controller
{
    public function index()
    {
        return view('auth.password_request_form');
    }

    public function requestResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return back()->with('error', 'The email you entered is not registered!');
        }

        $clientIpAddress = $request->getClientIp();
        $clientDevice = $request->header('User-Agent');
        $timestamp = Carbon::now()->toDateTimeString();
        $currentUserInfo = Location::get($clientIpAddress);
        $locationInfo = $currentUserInfo ? $currentUserInfo->regionName . ', ' . $currentUserInfo->cityName . ', ' . $currentUserInfo->countryName : "Unknown location";
        $token = \Str::random(64);


        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $actionLink = route('password.reset', ['token' => $token, 'email' => $request->email]);

        $mailData = [
            'user' => $user->fname . ' ' . ($user->lname ? $user->lname : ''),
            'recipient' => $request->email,
            'from' => config('mail.from.address'),
            'name' => config('app.name'),
            'subject' => $user->fname . ', here\'s your password reset link',
            'clientIpAddress' => $clientIpAddress,
            'clientDevice' => $clientDevice,
            'locationInfo' => $locationInfo,
            'timestamp' => $timestamp,
            'actionLink' => $actionLink
        ];

        $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautyMail->send('mail.password_reset_link', $mailData, function($message) use ($mailData)
        {
            $message->to($mailData['recipient'])
                    ->from($mailData['from'], $mailData['name'])
                    ->subject($mailData['subject']);
        });

        return view('auth.link_sent_success');
    }

    public function passwordResetForm(Request $request, $token = null)
    {

        return view('auth.password_reset_form')->with(['token' => $token, 'email'=>$request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        $checkToken = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if(!$checkToken)
        {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        if($request->password !== $request->password_confirmation)
        {
            return back()->with('error', 'The passwords you entered do not match!');
        }

        User::where('email', $request->email)->update([ 'password' => \Hash::make($request->password) ]);
        DB::table('password_resets')->where([ 'email' => $request->email ])->delete();

        $token = \Str::random(64);
        $actionLink = route('password.reset', ['token' => $token, 'email' => $request->email]);
        $clientIpAddress = $request->getClientIp();
        $clientDevice = $request->header('User-Agent');
        $timestamp = Carbon::now();
        $currentUserInfo = Location::get($clientIpAddress);
        $locationInfo = $currentUserInfo ? $currentUserInfo->regionName . ', ' . $currentUserInfo->cityName . ', ' . $currentUserInfo->countryName : "Unknown location";

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => $timestamp,
        ]);

        $mailData = [
            'user' => $user->fname . ' ' . ($user->lname ? $user->lname : ''),
            'recipient' => $request->email,
            'from' => config('mail.from.address'),
            'name' => config('app.name'),
            'subject' => 'Password changed',
            'clientIpAddress' => $clientIpAddress,
            'clientDevice' => $clientDevice,
            'locationInfo' => $locationInfo,
            'timestamp' => $timestamp->toDateTimeString(),
            'passwordResetLink' => $actionLink
        ];

        $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautyMail->send('mail.password_changed', $mailData, function($message) use ($mailData)
        {
            $message->to($mailData['recipient'])
                    ->from($mailData['from'], $mailData['name'])
                    ->subject($mailData['subject']);
        });

        return \redirect()->route('login')->with('success', 'Password was successfully changed!');
    }
}
