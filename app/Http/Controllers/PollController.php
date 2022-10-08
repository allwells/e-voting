<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\User;
use App\Models\Option;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        if(Auth::user()->role != 'super admin')
        {
            return view('user.polls', $data);
        }

        return view('superuser.polls', [ 'polls' => Poll::sortable()->paginate(25), 'options' => $options, 'responses' => $responses, 'today' => $today ]);
    }

    public function search(Request $request)
    {
        $result = "";
        $polls = Poll::where('title', 'Like', '%' . $request->slug . '%')->get();

        foreach($polls as $index => $poll)
        {
            $totalResponses = Response::where('poll_id', $poll->id)->get()->count();
            $result.=
                '<tr class="hover:bg-neutral-50">
                <td class="px-3 text-center cursor-default w-fit">
                    ' . $index+1 . '
                </td>

                <td class="px-2 py-3 text-left">
                    ' . $poll->title . '
                </td>

                <td class="px-2 py-3 text-center">
                    ' . $totalResponses . '
                </td>

                <td class="text-center capitalize cursor-default">
                    <button id="'. "dropdownLeftStartButton-$poll->id" .'" data-dropdown-toggle="' . "dropdownLeftStart-$poll->id" . '"
                        data-dropdown-placement="left-start"
                        class="p-1 rounded hover:bg-neutral-200 focus:bg-neutral-300 focus:text-neutral-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                            </path>
                        </svg>
                    </button>

                    <div id="' . "dropdownLeftStart-$poll->id" . '"
                        class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-52 dark:bg-neutral-700">
                        <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="'. "dropdownLeftStartButton-$poll->id" .'">
                            <li>
                                <a href="' . route('polls.show', $poll->id) . '"
                                    class="flex items-center justify-start w-full gap-2 p-3 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                    View
                                </a>
                            </li>
                            <li>
                                <form action="' . route('polls.destroy', $poll) . '" method="POST">
                                    @method(DELETE)
                                    @csrf

                                    <button type="submit"
                                        class="flex items-center justify-start w-full gap-2 p-3 text-left transition duration-300 rounded-lg text-rose-600 hover:bg-neutral-100">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>';
        }

        return response($result);
    }

    /**
     * Get all polls
     *
     * @return \Illuminate\Http\Response
     */

    public function getPolls()
    {
        $polls = Poll::all();

        return response()->json($polls);
    }

    /**
     * Store response from a user to a poll
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newResponse = [
            'user_id' => $request->user_id,
            'poll_id' => $request->poll_id,
            'option_id' => $request->option_id,
        ];

        Response::create($newResponse);

        $options = Option::where('poll_id', $request->poll_id)->get();
        $responses = array_count_values(Response::where('poll_id', $request->poll_id)->where('user_id', $request->user_id)->pluck('option_id')->toArray());

        // Get total number of responses for each options for this poll.
        $response = array_count_values(Response::all()->pluck('option_id')->toArray());

        // Get total responses for this poll
        $totalResponses = Response::where('poll_id', $request->poll_id)->count();

        return response()->json([
            'options' => $options,
            'response' => $response,
            'responses' => $responses,
            'totalResponses' => $totalResponses
        ]);
    }

    /**
     * Display form for creating polls
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $isUnauthorizedUser = auth() && (Auth::user()->role != 'super admin') && (Auth::user()->role != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        if(Auth::user()->role === 'admin')
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
        $isUnauthorizedUser = auth() && (Auth::user()->role != 'super admin') && (Auth::user()->role != 'admin');

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

        if($validator->fails()) {
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
                $options = new Option();
                $options->poll_id = $poll->id;
                $options->value = $option;
                $options->save();
            }

            $superusers = User::where('role', 'super admin')->get();
            $user = User::where('id', $poll->user_id)->first();

            foreach($superusers as $superuser)
            {
                $newNotification = [
                    'user_id' => $superuser->id,
                    'event_id' => $poll->id,
                    'message' => '<p class="flex items-center justify-start w-fit"><strong class="mr-1">'. "$user->fname $user->lname" .'</strong> created a poll: <strong class="mx-1">' . $poll->title . '</strong></p>',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                DB::table('notifications')->insert($newNotification);
            }

            if($request->user()->role === 'super admin')
            {
                return \redirect()->route('polls.show', $poll)->with('success', 'You successfully created a poll!');
            } else {
                return back()->with('success', 'You successfully opened a poll!');
            }
        }

        return back()->with('error', 'Oops! There was an error.');
    }

    public function view(Poll $poll, Request $request)
    {
        $options = Option::all();
        $responses = Response::all();

        // get logged in user id
        $userId = Auth::user()->id;

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

        $notification = DB::table('notifications')->where('user_id', $request->user()->id)->where('event_id', $poll->id)->where('isRead', 0)->first();

        if($notification)
        {
            DB::table('notifications')->where('user_id', $request->user()->id)->where('event_id', $poll->id)->where('isRead', 0)->update([ 'isRead' => 1]);
        }

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
        $isUnauthorizedUser = auth() && (Auth::user()->role != 'super admin') && (Auth::user()->role != 'admin');

        if($isUnauthorizedUser)
        {
            return back()->with('error', 'Unauthorized action.');
        }

        // get all notifications that has this event_id
        $notifications = DB::table('notifications')->where('event_id', $poll->id)->get();

        // extract the id of the retrieved notifications into an array
        $notificationIds = $notifications->pluck('id')->toArray();

        // delete notification if id is in $noticationIds array
        DB::table('notifications')->whereIn('id', $notificationIds)->delete();

        // Delete poll
        $poll->delete();

        return back()->with('success', 'Poll deleted!');
    }
}
