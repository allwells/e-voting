<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class PasswordReset extends Controller
{
    public function index()
    {
        return view('auth.forgot_password_email_request');
    }

    public function store(Request $request)
    {
        $MIN_OTP = 000000;
        $MAX_OTP = 999999;
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return back()->with('error', 'The email you entered is not in our database!');
        }

        $clientIpAddress = $request->getClientIp();
        $clientDevice = $request->header('User-Agent');
        $timestamp = Carbon::now()->toDateTimeString();
        $currentUserInfo = Location::get($clientIpAddress);
        $locationInfo = $currentUserInfo ? $currentUserInfo->regionName . ', ' . $currentUserInfo->cityName . ', ' . $currentUserInfo->countryName : "Unknown location";
        $otp = rand($MIN_OTP, $MAX_OTP);

        $mailData = [
            'user' => $user->fname . ' ' . ($user->lname ? $user->lname : ''),
            'recipient' => $request->email,
            'from' => config('mail.from.address'),
            'name' => config('app.name'),
            'subject' => $user->fname . ', here\'s your PIN',
            'clientIpAddress' => $clientIpAddress,
            'clientDevice' => $clientDevice,
            'locationInfo' => $locationInfo,
            'timestamp' => $timestamp,
            'otp' => $otp
        ];

        $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautyMail->send('mail.password_reset_otp', $mailData, function($message) use ($mailData)
        {
            $message->to($mailData['recipient'])
                    ->from($mailData['from'], $mailData['name'])
                    ->subject($mailData['subject']);
        });

        return back()->with('success', 'Check your email for the otp sent.');
    }
}
