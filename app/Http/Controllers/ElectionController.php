<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        return view('elections', [
            'today' => $today,
            'elections' => Election::all()
        ]);
    }

    public function showCreate()
    {
        return view('create_election');
    }

    public function create(Request $request, Election $election)
    {
        // get user privilege
        $isUnauthorizedUser = (auth() && auth()->user()->privilege !== 'superuser') && (auth() && auth()->user()->privilege !== 'admin');

        if($isUnauthorizedUser)
        {
            return abort(403, 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'max:300',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $election_values = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            $query = DB::table('elections')->insert($election_values);

            $electionId = Election::where('created_at', $election_values['created_at'])->where('updated_at', $election_values['updated_at'])->get();

            foreach($request->name as $key => $candidate_name) {
                $candidate = new Candidate;

                $candidate->election_id = $electionId[0]->id;
                $candidate->name = $candidate_name;
                $candidate->party = $request->party[$key];
                $candidate->save();
            }

            if($query > 0)
            {
                return response()->json(['status' => 200, 'message' => 'Election created successfully!']);
            }
        }

        return back();
    }

    public function show(Request $request, Election $election)
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $today);

        $votes = Vote::all();
        $elections = Election::whereId($election->id)->first();
        $candidates = Candidate::where('election_id', $election->id)->get();
        $voted = Vote::where('user_id', auth()->user()->id)->where('election_id', $elections->id)->first();

        return view('show_elections', [
            'votes' => $votes,
            'today' => $today,
            'voted' => $voted,
            'election' => $elections,
            'candidates' => $candidates,
        ]);
    }

    public function vote(Request $request)
    {
        Vote::create([
            'user_id' => $request->user()->id,
            'election_id' => (int) $request->election,
            'candidate_id' => (int) $request->candidate,
        ]);

        return back();
    }

    public function close(Election $election)
    {
        Election::where('id', $election->id)->update([
            'status' => 'closed',
        ]);

        return back();
    }

    public function showEdit(Election $election)
    {   $candidates = Candidate::where('election_id', $election->id)->get();

        return view('edit_election', [
            'election' => $election,
            'candidates' => $candidates
        ]);
    }

    public function edit(Request $request, Election $election)
    {
        // get user privilege
        $isUnauthorizedUser = (auth() && auth()->user()->privilege !== 'superuser') && (auth() && auth()->user()->privilege !== 'admin');

        if($isUnauthorizedUser)
        {
            return abort(403, 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'max:300',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $election_values = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'updated_at' => date('Y-m-d H:i:s')
            ];

            Election::where('id', $election->id)->update($election_values);

            foreach($request->name as $key => $candidate_name) {
                $exists = Candidate::where('election_id', $election->id)->where('name', $candidate_name)->where('party', $request->party[$key])->get();

                if($exists->count() > 0)
                {
                    Candidate::where('election_id', $election->id)->update([
                        'name' => $candidate_name,
                        'party' => $request->party[$key]
                    ]);
                } else {
                    Candidate::create([
                        'election_id' => $election->id,
                        'name' => $candidate_name,
                        'party' => $request->party[$key]
                    ]);
                }
            }
        }

        return back();
    }

    public function destroy(Election $election)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser' || auth() && auth()->user()->privilege !== 'user';

        if(isUnauthorizedUser)
        {
            return abort(403, 'Unauthorized action.');
        }

        $election->delete();

        return back();
    }
}