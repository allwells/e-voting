<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Response;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display list of polls
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $polls = Poll::all();
        $options = Option::all();
        $responses = Response::all();

        $data = [ 'polls' => $polls, 'options' => $options, 'responses' => $responses ];

        if(auth()->user()->privilege != 'superuser')
        {
            return view('user.polls', $data);
        }

        return view('superuser.polls', $data);
    }

    /**
     * Store response from a user to a poll
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $pollId = (int) $request->poll;
        $optionId = (int) $request->option;

        Response::create([
            'user_id' => $userId,
            'poll_id' => $pollId,
            'option_id' => $optionId,
        ]);

        return back();
    }
}
