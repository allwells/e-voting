<?php

namespace App\Http\Controllers\Superuser;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::where('privilege', '!=', 'superuser')->orderBy('privilege')->paginate(10);
        $users = User::class;

        return view('superuser.users', [
            'users' => $users::where('privilege', '!=', 'superuser')->orderBy('privilege')->paginate(10)
        ]);
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