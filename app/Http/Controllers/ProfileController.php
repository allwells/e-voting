<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class ProfileController extends Controller
{
    /**
     * Get the page the user should see when the user goes to the '/profile' route.
     *
     * @return string, array<object>
     */
    public function index()
    {
        // Get authenticated user.
        $user = auth()->user();

        // return profile page
        return view('profile',
            [
                'user' => $user,
            ]
        );
    }

    public function upload($file, $options = [])
    {
        (new UploadApi())->upload($file);
    }

    /**
     * Update user details in the databae with user inputs given.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store(Request $request)
    {
        // Configuration::instance([
        //     'cloud' => [
        //       'cloud_name' => env('CLOUD_NAME'),
        //       'api_key' => env('API_KEY'),
        //       'api_secret' => env('API_SECRET')],
        //     'url' => [
        //       'secure' => true]]);

            //   upload('filename.jpg');

        // Update user
        User::where('id', auth()->user()->id)->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $this->purify($request->phone),
            'dob' => $request->dob,
        ]);

        return back();
    }

    /**
     * Remove unwanted characters from phone number string.
     *
     * @param  string  $phone
     * @return string
     */
    protected function purify($phone)
    {
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);

        return $phone;
    }
}
