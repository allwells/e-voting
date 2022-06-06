<?php

namespace App\Http\Controllers\Admin;

use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddCandidateController extends Controller
{

    /**
     * Get the page that the user sees when the user goes to 'add-candidates' route
     *
     * @return function
     */
    public function index()
    {
        $elections = Election::all();

        return view('admin.add_candidate', [
            'elections' => $elections,
        ]);
    }

    /**
     * Get candidate details from request and stores them in database
     *
     * @param  Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'party' => 'required|max:50',
        ]);

        if(!$validator->passes()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()->toArray()]);
        } else {
            $values = [
                'name' => $request->name,
                'party' => $request->party,
                'election_id' => (int) $request->election_id,
                'image' => $request->image,
            ];

            $query = DB::table('candidates')->insert($values);

            if($query > 0)
            {
                return response()->json(['status' => 200, 'message' => 'Candidate added successfully!']);
            }
        }

        return back();
    }
}
