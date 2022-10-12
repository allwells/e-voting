<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

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
        // $clientIpAddress = $request->getClientIp();
        // $clientDevice = $request->header('User-Agent');
        // $timestamp = Carbon::now();
        // $currentUserInfo = Location::get($clientIpAddress);
        // $locationInfo = $currentUserInfo ? $currentUserInfo->regionName . ', ' . $currentUserInfo->cityName . ', ' . $currentUserInfo->countryName : "Unknown location";

        // validate user input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
            ]
        );

        /**
         * Authenticate user and @return error message if authentication fails.
         */
        if(!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('error', 'Invalid email or password!');
        }

        if(Auth::user()->role === "super admin") {
            return redirect()->route('dashboard');
        }


        // $token = \Str::random(64);

        // DB::table('password_resets')->insert([
        //     'email' => auth()->user()->email,
        //     'token' => $token,
        //     'created_at' => $timestamp,
        // ]);

        // $actionLink = route('password.reset', ['token' => $token, 'email' => auth()->user()->email]);

        // $mailData = [
        //     'recipient' => auth()->user()->email,
        //     'from' => config('mail.from.address'),
        //     'name' => config('app.name'),
        //     'subject' => "New login to e-Voting",
        //     'clientIpAddress' => $clientIpAddress,
        //     'clientDevice' => $clientDevice,
        //     'locationInfo' => $locationInfo,
        //     'timestamp' => $timestamp->toDateTimeString(),
        //     'passwordResetLink' => $actionLink
        // ];

        // $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        // $beautyMail->send('mail.login', $mailData, function($message) use ($mailData)
        // {
        //     $message->to($mailData['recipient'])
        //             ->from($mailData['from'], $mailData['name'])
        //             ->subject($mailData['subject']);
        // });

        // redirect user to intended page
        return redirect()->intended('');
    }

}
