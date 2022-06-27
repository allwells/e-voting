<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Election;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_admins = User::where('privilege', 'admin')->get();
        $users = User::where('privilege', 'user')->take(7)->get();
        $admins = User::where('privilege', 'admin')->take(7)->get();
        $total_users = User::where('privilege','!=', 'superuser')->get();
        $elections = Election::all();

        return view('dashboard', [
            'users' => $users,
            'admins' => $admins,
            'elections' => $elections,
            'total_users' => $total_users,
            'total_admins' => $total_admins,
        ]);
    }
}