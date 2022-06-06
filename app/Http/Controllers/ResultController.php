<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $elections = Election::all();

        return view('result', [
            'elections' => $elections
        ]);
    }

    public function show(Request $request)
    {
        dd($request);
    }
}
