<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Get all options
     *
     * @return \Illuminate\Http\Response
     */

    public function getOptions()
    {
        $options = Option::all();

        return response()->json($options);
    }
}