<?php

namespace App\Http\Controllers\Superuser;

use Carbon\Carbon;
use App\Models\User;
use App\Imports\FileImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Snowfire\Beautymail\Beautymail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege != 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        return view('superuser.users', [
            'users' => User::where('privilege', '!=', 'superuser')->paginate(25),
        ]);
    }

    public function getAddUser()
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege != 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        return view('superuser.add_user');
    }

    public function addUser(Request $request)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege != 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:50',
            'lname' => 'max:50',
            'email' => 'required|email|unique:users|max:120',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Something went wrong! Check your inputs and try again.');
        } else {
            $genPassword = Str()->random(32);
            $passwordHash = Hash::make($genPassword);
            $user = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => ($request->phone == null ? '' : $request->phone),
                'password' => $passwordHash,
            ];

            $query = DB::table('users')->insert($user);
            $recipient = $user['email'];

            $mailData = [
                'recipient' => $user,
                'from' => config('mail.from.address'),
                'name' => config('app.name'),
                'subject' => "Account Creation",
                'genPassword' => $genPassword
            ];

            $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautyMail->send('mail.account_creation', $mailData, function($message) use ($mailData, $recipient)
            {
                $message->to($recipient)
                        ->from($mailData['from'], $mailData['name'])
                        ->subject($mailData['subject']);
            });

            if($query > 0)
            {
                return back()->with('success', 'User added successfully!');
            }
        }
    }

    public function privilege(User $user)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege != 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if($user->privilege == 'user')
        {
            User::where('id', $user->id)->update([
                'privilege' => 'admin',
            ]);

            return back()->with('success', $user->fname . ' ' . $user->lname . ' is now an admin.');
        }

        if($user->privilege == 'admin')
        {
            User::where('id', $user->id)->update([
                'privilege' => 'user',
            ]);

            return back()->with('success', 'Admin privilege revoked from ' . $user->fname . ' ' . $user->lname);
        }

        return back()->with('error', 'Oops! Something went wrong. Try again.');
    }

    public function fileImport(Request $request)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege != 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $extension = $request->file('imported_file')->getClientOriginalExtension();

        if($extension != 'csv' && $extension != 'xls' && $extension != 'xlsx')
        {
            return back()->with('error', 'Invalid file format! Preferred file format: .csv, .xls or .xlsx');
        }

        $path = storage_path('app') . '/' . $request->file('imported_file')->store('temp');
        $uploadedData = Excel::toArray(new FileImport, $path);

        foreach($uploadedData[0] as $users)
        {
            $genPassword = Str()->random(32);
            $passwordHash = Hash::make($genPassword);

            $user = new User();
            $user->fname = $users['first_name'];
            $user->lname = $users['last_name'] ? $users['last_name'] : null;
            $user->email = $users['email'];
            $user->password = $passwordHash;
            $user->save();

            $userId = $user->id;

            $recipient = $users['email'];

            $mailData = [
                'recipient' => ['fname' => $users['first_name']],
                'from' => config('mail.from.address'),
                'name' => config('app.name'),
                'subject' => "Account Creation",
                'genPassword' => $genPassword
            ];

            $beautyMail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautyMail->send('mail.account_creation', $mailData, function($message) use ($mailData, $recipient)
            {
                $message->to($recipient)
                        ->from($mailData['from'], $mailData['name'])
                        ->subject($mailData['subject']);
            });
        }

        return back()->with('success', 'User account created successfully!');
    }

    public function destroy(User $user)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action!');
        }

        $user->delete();

        return back()->with('success', 'User deleted!');
    }
}
