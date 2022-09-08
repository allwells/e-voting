<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Display form for creating polls
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if(auth()->user()->privilege == 'admin')
        {
            return view('user.create_poll');
        } else {
            return view('superuser.create_poll');
        }
    }

    /**
     * Create/Open a poll
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $isUnauthorizedUser = auth() && (auth()->user()->privilege != 'superuser') && (auth()->user()->privilege != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        // validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

        if(!$validator->passes()) {
            return back()->with('warn', 'Oops! Something\'s not right. Check your inputs and try again.');
        } else {
            $startDate = $request->start_date . " " . $request->start_time . ":00";
            $endDate = $request->end_date . " " . $request->end_time . ":00";

            // Create poll instance
            $poll = new Poll();
            $poll->title = $request->title;
            $poll->user_id = $request->user()->id;
            $poll->start_date = $request->start_date ? $startDate : date('Y-m-d H:i:s');
            $poll->end_date = $endDate;
            $poll->save();

            foreach($request->options as $option)
            {
                $options = new Option;
                $options->poll_id = $poll->id;
                $options->value = $option;
                $options->save();
            }

            return back()->with('success', 'You successfully opened a poll!');
            // return \redirect()->route('polls.show', $election)->with('success', 'You successfully opened a poll!');
        }

        return back()->with('error', 'Oops! There was an error.');
    }
}
