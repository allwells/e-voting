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
        $isUnauthorizedUser = Auth::user()->role != 'super admin';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        $users = User::where('role', '!=', 'super admin')->sortable()->paginate(25);

        return view('superuser.users', compact('users'));
    }

    public function search(Request $request)
    {
        $result = "";

        $users = User::where('fname', 'Like', '%' . $request->slug . '%')->orWhere('lname', 'Like', '%' . $request->slug . '%')->orWhere('email', 'Like', '%' . $request->slug . '%')->get();

        foreach($users as $index => $user)
        {
            if($user->role !== 'super admin')
            {
                $result.=
                    '<tr class="hover:bg-neutral-50">
                    <td class="px-3 text-center cursor-default w-fit">
                        ' . $index . '
                    </td>

                    <td class="px-2 py-3 text-left">
                        ' . $user->fname . '
                    </td>

                    <td class="px-2 py-3 text-left">
                    ' . $user->lname . '
                    </td>

                    <td class="px-2 py-3 text-left">
                    ' . $user->email . '
                    </td>

                    <td class="px-2 py-3 text-left">
                    ' . $user->role . '
                    </td>

                    <td class="text-center capitalize cursor-default">
                        <button id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart-$user->id"
                            data-dropdown-placement="left-start"
                            class="p-1 rounded hover:bg-neutral-200 focus:bg-neutral-300 focus:text-neutral-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                </path>
                            </svg>
                        </button>

                        <div id="dropdownLeftStart-$user->id"
                            class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-52 dark:bg-neutral-700">
                            <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                                <li>
                                    <form action="{{ route(' . 'users.role' . ', ' . $user->id . ') }}" method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="flex items-center justify-start w-full gap-2 p-3 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                            @if (' . $user->role . ' == "admin")
                                                Remove admin role
                                            @else
                                                Make admin
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                {{-- <li>
                                    <form action="{{ route(' . 'users.block' . ', ' . $user->id . ') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center justify-start w-full gap-2 p-3 text-left transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                            Block user
                                        </button>
                                    </form>
                                </li> --}}
                                <li>
                                    <form action="{{ route(' . 'users.destroy' . ', ' . $user->id . ') }}" method="POST">
                                        @csrf
                                        @method(' . 'DELETE' . ')

                                        <button type="submit"
                                            class="flex items-center justify-start w-full gap-2 p-3 text-left transition duration-300 rounded-lg text-rose-600 hover:bg-neutral-100">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>';
            }
        }

        return response($result);
    }

    public function getAddUser()
    {
        $isUnauthorizedUser = Auth::user()->role != 'super admin';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        return view('superuser.add_user');
    }

    public function addUser(Request $request)
    {
        $isUnauthorizedUser = Auth::user()->role != 'super admin';

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

        if($validator->fails()) {
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

    public function role(User $user)
    {
        $isUnauthorizedUser = Auth::user()->role != 'super admin';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if($user->role == 'user')
        {
            User::where('id', $user->id)->update([
                'role' => 'admin',
            ]);

            return back()->with('success', $user->fname . ' ' . $user->lname . ' is now an admin.');
        }

        if($user->role == 'admin')
        {
            User::where('id', $user->id)->update([
                'role' => 'user',
            ]);

            return back()->with('success', 'Admin role revoked from ' . $user->fname . ' ' . $user->lname);
        }

        return back()->with('error', 'Oops! Something went wrong. Try again.');
    }

    public function fileImport(Request $request)
    {
        $isUnauthorizedUser = Auth::user()->role != 'super admin';

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
        $isUnauthorizedUser = Auth::user()->role !== 'super admin';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action!');
        }

        $user->delete();

        return back()->with('success', 'User deleted!');
    }
}
