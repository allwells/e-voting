<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Get all responses
     *
     * @return \Illuminate\Http\Response
     */

    public function getResponses()
    {
        $responses = Response::all();

        return response()->json($responses);
    }
}