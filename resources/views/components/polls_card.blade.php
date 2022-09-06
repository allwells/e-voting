@props(['poll' => $poll, 'options' => $options, 'responses' => $responses])

@php
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
$responders = \App\Models\Response::where('poll_id', 1)
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
@endphp

<div class="md:border w-full md:p-5 relative rounded-2xl">
    <h1 class="text-lg font-medium text-neutral-700">What programming language are you proficient in?</h1>

    <div class="flex flex-col justify-start items-start relative w-full mt-3 gap-3">
        @if ($options->count() > 0)
            @foreach ($options as $option)
                @if ($option->poll_id === $poll->id)
                @if($now->lt($endDate))
                    @if (!$responseExists)
                        <form action="{{ route('polls.respond', [$poll->id, $option->id]) }}" method="POST"
                            class="w-full">
                            @csrf

                            <div
                                class="w-full border border-neutral-300 flex justify-start items-center overflow-hidden rounded-lg">
                                <button type="submit"
                                    class="text-left text-sm font-medium text-neutral-700 w-full rounded-lg p-3.5 hover:bg-neutral-100 transition duration-200">
                                    {{ $option->value }}
                                </button>
                            </div>
                        </form>
                    @else
                        <div
                            class="w-full relative flex justify-start items-center rounded-lg overflow-hidden border border-neutral-300">
                            <button type="button"
                                style="width: {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%;"
                                class="bg-neutral-300 cursor-default text-left transition duration-1000 text-neutral-700 flex justify-start items-start border-0 outline-0 w-full min-h-[2.5rem]">
                                <span class="absolute w-full min-h-[2.5rem] flex justify-between items-center px-3">
                                    <span class="relative flex justify-start items-center gap-1 font-medium text-sm">
                                        @if ($responseExists->option_id === $option->id)
                                            <span class="w-fit h-fit relative">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        @endif
                                        {{ $option->value }}
                                    </span>

                                    <span class="text-sm font-bold text-neutral-800">
                                        {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%
                                    </span>
                                </span>
                            </button>
                        </div>
                    @endif
                    @else
                    <div
                    class="w-full relative flex justify-start items-center rounded-lg overflow-hidden border border-neutral-300">
                    <button type="button"
                        style="width: {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%;"
                        class="bg-neutral-300 cursor-default text-left transition duration-1000 text-neutral-700 flex justify-start items-start border-0 outline-0 w-full min-h-[2.5rem]">
                        <span class="absolute w-full min-h-[2.5rem] flex justify-between items-center px-3">
                            <span class="relative flex justify-start items-center gap-1 font-medium text-sm">
                                {{ $option->value }}
                            </span>

                            <span class="text-sm font-bold text-neutral-800">
                                {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%
                            </span>
                        </span>
                    </button>
                </div>
                    @endif
                @endif
            @endforeach
        @else
            <div class="py-5 text-center flex justify-center items-center text-sm text-neutral-600 w-full relative">
                No options for this poll.
            </div>
        @endif
    </div>

    <div class="mt-3 text-sm text-neutral-500 flex justify-start items-center gap-2">
        <div class="flex justify-start items-center -space-x-3">
            @foreach ($users as $user)
                <div style="background-image: url('{{ $user->image ? $user->image : asset('icons/default_user.svg') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;"
                class="border-2 border-white min-h-[2rem] min-w-[2rem] h-[2rem] w-[2rem] rounded-full">
                </div>
            @endforeach
        </div>

        <span>
            Total Responses:
            <span class="font-bold">
                @if ($isThousand)
                    {{ round($totalResponses / 1000, 1) }}K
                @elseif ($isMillion)
                    {{ round($totalResponses / 1000000, 1) }}M
                @elseif ($isBillion)
                    {{ round($totalResponses / 1000000000, 1) }}B
                @elseif ($isTrillion)
                    {{ round($totalResponses / 1000000000000, 1) }}T
                @else
                    {{ $totalResponses }}
                @endif
            </span>
        </span>

        <span class="text-2xl">•</span>

        @if ($years > 0)
            <span class="font-bold">{{ $years }} {{ $years == 1 ? 'year' : 'years' }} left</span>
        @elseif ($months > 0)
            <span class="font-bold">{{ $months }} {{ $months == 1 ? 'month' : 'months' }} left</span>
        @elseif ($days > 0)
            <span class="font-bold">{{ $days }} {{ $days == 1 ? 'day' : 'days' }} left</span>
        @elseif ($hours > 0)
            <span class="font-bold">{{ $hours }} {{ $hours == 1 ? 'hour' : 'hours' }} left</span>
        @elseif ($minutes > 0)
            <span class="font-bold">{{ $minutes }} {{ $minutes == 1 ? 'minute' : 'minutes' }} left</span>
        @else
            <span class="font-bold">Few seconds left</span>
        @endif
    </div>
</div>
