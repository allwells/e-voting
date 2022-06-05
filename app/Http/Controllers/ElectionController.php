<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();

        return view('elections', [
            'elections' => $elections
        ]);
    }

    public function store(Request $request)
    {
        // get user privilege
        $user = auth()->user()->privilege;

        if(auth() && $user !== 'admin')
        {
            return abort(403, 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'description' => 'max:300',
                'type' => 'required',
                'start_date' => 'required',
                'start_time' => 'required',
                'end_date' => 'required',
                'end_time' => 'required',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $start_time = $request->start_time . ':00';
            $end_time = $request->end_time . ':00';

            $values = [
                    'user_id' => $request->user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'start_date' => $request->start_date . ' ' . $start_time, // Concatinate election start time with start date
                    'end_date' => $request->end_date . ' ' . $end_time, // Concatinate election end time with end date
            ];

            $query = DB::table('elections')->insert($values);

            if($query > 0)
            {
                return response()->json(['status' => 200, 'message' => 'Election created successfully!']);
            }
        }

        return back();
    }
}
