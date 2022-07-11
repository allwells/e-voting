<?php

namespace App\Http\Controllers\Superuser;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::where('privilege', '!=', 'superuser')->orderBy('privilege')->paginate(10);
        $users = User::class;

        return view('superuser.users', [
            'users' => $users::where('privilege', '!=', 'superuser')->paginate(25)
        ]);
    }

    public function getAddUser()
    {
        return view('superuser.add_user');
    }

    public function addUser(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'fname' => 'required|max:50',
            'lname' => 'max:50',
            'email' => 'required|email|unique:users|max:120',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Something went wrong! Check your inputs and try again.');
        } else {
            $values = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => ($request->phone == null ? '' : $request->phone),
                'password' => \Hash::make($request->email),
            ];

            $query = DB::table('users')->insert($values);

            if($query > 0)
            {
                return back()->with('success', 'User added!');
            }
        }
    }

    public function privilege(User $user)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action!');
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
