<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\User;
use App\Models\Option;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        $today = Carbon::now();
        $polls = Poll::all();
        $options = Option::all();
        $responses = Response::all();

        $data = [ 'polls' => $polls, 'options' => $options, 'responses' => $responses, 'today' => $today ];

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

            // $superusers = User::where('privilege', 'superuser')->get();
            // $user = User::where('id', $poll->user_id)->first();

            // foreach($superusers as $superuser)
            // {
            //     $newNotification = [
            //         'user_id' => $superuser->id,
            //         'election_id' => $poll->id,
            //         'message' => '<strong>'. "$user->fname $user->lname" .'</strong> created a poll: <a class="underline" href="{{ route("polls.show", $poll->id) }}"><strong>' . $poll->title . '</strong></a>',
            //         'created_at' => date('Y-m-d H:i:s'),
            //         'updated_at' => date('Y-m-d H:i:s')
            //     ];

            //     DB::table('notifications')->insert($newNotification);
            // }

            if($request->user()->privilege === 'superuser')
            {
                return \redirect()->route('poll.view', $poll)->with('success', 'You successfully created a poll!');
            } else {
                return back()->with('success', 'You successfully opened a poll!');
            }
        }

        return back()->with('error', 'Oops! There was an error.');
    }

    public function view(Poll $poll)
    {
        $options = Option::all();
        $responses = Response::all();

        // get logged in user id
        $userId = auth()->user()->id;

        // check if current logged in user's id exists in response
        $responseExists = $responses
            ->where('poll_id', $poll->id)
            ->where('user_id', $userId)
            ->first();

        // Get total responses for this poll
        $totalResponses = $responses->where('poll_id', $poll->id)->count();

        // Get total number of responses for each options for this poll.
        $response = array_count_values($responses->pluck('option_id')->toArray());

        // Get list of all response for this poll,
        // reverse the collection and then pluck user_id from each into an array,
        // and finally, get the first 3 elements of the array.
        $responders = \App\Models\Response::where('poll_id', $poll->id)
            ->latest()
            ->take(3)
            ->get()
            ->pluck('user_id')
            ->toArray();

        // empty users collection
        $users = collect();

        // Get all users and check is user id exists in 'responders' array,
        // if user id exists, then push data into 'users' collection
        foreach (\App\Models\User::all() as $user) {
            if (in_array($user->id, $responders)) {
                $users->push($user);
            }
        }

        // check is total responses of is in thousands, millions, billions or trillions
        $isThousand = $totalResponses > 1000 && $totalResponses < 1000000;
        $isMillion = $totalResponses > 1000000 && $totalResponses < 1000000000;
        $isBillion = $totalResponses > 1000000000 && $totalResponses < 1000000000000;
        $isTrillion = $totalResponses > 1000000000000 && $totalResponses < 1000000000000000;

        $now = \Carbon\Carbon::now(); // get current time and date
        $endDate = \Carbon\Carbon::parse($poll->end_date); // convert poll end date to Carbon format

        $seconds = $endDate->diffInSeconds($now); // get the difference in seconds between the poll end date and the today
        $minutes = $endDate->diffInMinutes($now); // get the difference in minutes between the poll end date and the today
        $hours = $endDate->diffInHours($now); // get the difference in hours between the poll end date and the today
        $days = $endDate->diffInDays($now); // get the difference in days between the poll end date and the today
        $months = $endDate->diffInMonths($now); // get the difference in months between the poll end date and the today
        $years = $endDate->diffInYears($now); // get the difference in years between the poll end date and the today

        return view('superuser.show_poll',
            [
                'now' => $now,
                'poll' => $poll,
                'days' => $days,
                'years' => $years,
                'hours' => $hours,
                'users' => $users,
                'months' => $months,
                'options' => $options,
                'endDate' => $endDate,
                'seconds' => $seconds,
                'minutes' => $minutes,
                'response' => $response,
                'responses' => $responses,
                'isBillion' => $isBillion,
                'isMillion' =>  $isMillion,
                'isThousand' => $isThousand,
                'isTrillion' => $isTrillion,
                'responseExists' => $responseExists,
                'totalResponses' => $totalResponses,
            ]
        );
    }

    public function destroy(Poll $poll)
    {

    }
}
