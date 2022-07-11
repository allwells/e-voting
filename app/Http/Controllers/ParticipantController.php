<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function destroy(Request $request)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action!');
        }

        $participantId = (int) $request->participant;

        if(!$participantId)
        {
            return back()->with('error', 'Oops! There was an error.');
        }

        Participant::where('id', $participantId)->delete();

        return back()->with('success', 'You successfully kicked out a participant.');
    }
}
