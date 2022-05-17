<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Get the view that the user should see when the user visits 'users' route.
     *
     * @param  App\Models\User  $user
     * @return (string, array<object>)
     */
    public function index()
    {
        // Get all users except 'superuser'
        $users = DB::table('users')->where('privilege','!=', 'superuser')->orderBy('privilege')->paginate(20);

        return view('user.users',
            [
                'users' => $users,
            ]
        );
    }
}