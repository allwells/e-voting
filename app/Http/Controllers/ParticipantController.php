<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function destroy(Participant $participant)
    {
        $isUnauthorizedUser = auth() && auth()->user()->privilege !== 'superuser';

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action!');
        }

        $participant->delete();

        return back()->with('success', 'User deleted!');
    }
}
