<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectionController extends Controller
{
    /**
     * Get the page that the user should see when the user visits '/elections' route.
     *
     * @return (string, array<object>)
     */
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);
        $election = DB::table('elections')->get();

        return view('user.election',
            [
                'elections' => $election,
                'today' => $today,
            ]
        );
    }

    /**
     * Get the page that the user should see when the user visits '/elections' route.
     *
     * @return (string, array<object>)
     */
    public function view_election(Election $election)
    {
        return view('user.view_election', [ 'election' => $election ]);
    }

    /**
     * Create an election and store in the database.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function
     */
    public function store(Request $request)
    {
        if(auth() && auth()->user()->privilege == 'superuser' || auth() && auth()->user()->privilege == 'admin')
        {
            // validate election inputs
            $this->validate($request, [
                'title' => 'required|max:100',
                'description' => 'required|max:250',
                'start_date' => 'required',
                'start_time' => 'required',
                'end_date' => 'required',
                'end_time' => 'required',
                ]
            );

            $start_time = $request->start_time . ':00';
            $end_time = $request->end_time . ':00';

            // store election in database
            Election::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date . ' ' . $start_time,
                'end_date' => $request->end_date . ' ' . $end_time,
                ]
            );

            return back();
        } else {
            return \redirect('/dashboard');
        }
    }
}