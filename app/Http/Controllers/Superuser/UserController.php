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
            'users' => $users::where('privilege', '!=', 'superuser')->paginate(10)
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
            'phone' => 'unique:users|min:10|max:15',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $values = [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => \Hash::make($request->email),
            ];

            $query = DB::table('users')->insert($values);

            if($query > 0)
            {
                return response()->json(['status' => 200, 'message' => 'User added successfully!']);
            }
        }
    }

    public function privilege(User $user)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return abort(403, 'Unauthorized action.');
        }

        if($user->privilege == 'user')
        {
            User::where('id', $user->id)->update([
                'privilege' => 'admin',
            ]);
        }

        if($user->privilege == 'admin')
        {
            User::where('id', $user->id)->update([
                'privilege' => 'user',
            ]);
        }

        return back();
    }

    public function destroy(User $user)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return back();
    }
}