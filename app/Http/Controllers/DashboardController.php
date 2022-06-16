<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Election;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admins = User::where('privilege', 'admin')->get();
        $users = User::where('privilege', 'user')->get();
        $elections = Election::all();

        return view('dashboard', [
            'users' => $users,
            'admins' => $admins,
            'elections' => $elections
        ]);
    }
}