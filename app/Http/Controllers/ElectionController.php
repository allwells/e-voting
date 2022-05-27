<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Election;
use App\Models\Candidate;
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
        $election = DB::table('elections')->orderBy('start_date')->get();

        foreach($election as $elections)
        {
            if($today->gt($elections->start_date) && $today->lt($elections->end_date) && $elections->status === '')
            {
                Election::where('status', $elections->status)->update([
                    'status' => 'open',
                ]);

                return back();
            }
        }


        foreach($election as $elections)
        {
            if($today->gt($elections->start_date) && $today->gt($elections->end_date) && $elections->status !== 'closed')
            {
                Election::where('status', $elections->status)->update([
                    'status' => 'closed',
                ]);

                return back();
            }
        }

        return view('user.election',
            [
                'elections' => $election,
                'today' => $today,
            ]
        );
    }

    /**
     * Create a candidate and store in database
     *
     * @param  Illuminate\Http\Request  $request
     * @return function, string
     */
    public function add_candidate(Request $request)
    {
        // get user privilege
        $user = auth()->user()->privilege;

        if((auth() && $user !== 'superuser') && (auth() && $user !== 'admin'))
        {
            return abort(403, 'Unauthorized action.');
        }

        // validate candidate inputs
        $this->validate($request, [
            'name' => 'required|max:50',
            'party' => 'max:50',
            ]
        );

        // store candidate in database
        Candidate::create([
            'election_id' => (int)$request->election,
            'name' => $request->name,
            'party' => $request->party,
            'image' => $request->image,
            ]
        );

        return back();
    }

    /**
     * Create an election and store in the database.
     *
     * @param  Illuminate\Http\Request  $request
     * @return function, string
     */
    public function store(Request $request)
    {
        // get user privilege
        $user = auth()->user()->privilege;

        if((auth() && $user !== 'superuser') && (auth() && $user !== 'admin'))
        {
            return abort(403, 'Unauthorized action.');
        }

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
            'start_date' => $request->start_date . ' ' . $start_time, // Concatinate election start time with start date
            'end_date' => $request->end_date . ' ' . $end_time, // Concatinate election end time with end date
            ]
        );

        return back();
    }

    public function close_election(Election $election)
    {
        Election::where('id', $election->id)->update([
            'status' => 'closed',
        ]);

        return back();
    }

    public function destroy(Election $election)
    {
        $user = auth()->user()->privilege;

        if((auth() && $user !== 'superuser') && (auth() && $user !== 'admin'))
        {
            return abort(403, 'Unauthorized action.');
        }

        $election->delete();

        return back();
    }
}