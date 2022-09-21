@extends('layout.layout')

@section('title', $poll->title)
@section('election-tab', auth()->user()->theme === 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div
        class="relative flex flex-col items-start justify-start w-full gap-5 text-justify md:bg-white min-h-fit rounded-2xl">

        <div class="relative w-full md:border md:p-5 rounded-2xl">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-neutral-700">{{ $poll->title }}</h1>

                <div class="w-fit h-fit">
                    <button type="button" id="pollsOptionDropDown{{ $poll->id }}" data-dropdown-toggle="polls-dropdown" class="flex items-center justify-center p-1 transition duration-200 rotate-90 rounded-full hover:bg-black/10 focus:ring ring-black/20 text-neutral-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    </button>

                    <div id="polls-dropdown" class="hidden z-10 min-w-[11rem] bg-white rounded-xl shadow-lg border">
                        <ul class="text-sm text-neutral-700 p-1.5 gap-1.5 flex flex-col"
                            aria-labelledby="pollsOptionDropDown{{ $poll->id }}">
                            <li>
                                <form action="{{ route('polls.destroy', $poll) }}" method="POST" class="w-full">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit"
                                        class="flex items-center justify-start w-full gap-1 px-3 py-2 text-sm font-bold transition duration-300 rounded-lg hover:text-red-700 hover:bg-red-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="poll-options" class="relative flex flex-col items-start justify-start w-full gap-3 mt-3">
                @if ($options->count() > 0)
                    @foreach ($options as $option)
                        @if ($option->poll_id === $poll->id)
                            @if($now->lt($endDate))
                                @if (!$responseExists)
                                    <form id="option-form-{{ $option->id }}" action="{{ route('polls.respond', $poll->id) }}" method="POST"
                                        class="w-full">
                                        @csrf

                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" id="userId" name="user_id" value="{{ auth()->user()->id }}" />
                                        <input type="hidden" id="pollId" name="poll_id" value="{{ $poll->id }}" />
                                        <input type="hidden" id="optionId" name="option_id" value="{{ $option->id }}" />

                                        <div
                                            class="flex items-center justify-start w-full overflow-hidden border rounded-lg border-neutral-300">
                                            <button type="submit"
                                                class="text-left text-sm font-medium text-neutral-700 w-full rounded-lg p-3.5 hover:bg-neutral-100 transition duration-200">
                                                {{ $option->value }}
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div
                                        class="relative flex items-center justify-start w-full overflow-hidden border rounded-lg border-neutral-300">
                                        <button type="button"
                                            style="width: {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%;"
                                            class="bg-neutral-300 cursor-default text-left transition duration-1000 text-neutral-700 flex justify-start items-start border-0 outline-0 w-full min-h-[2.5rem]">
                                            <span class="absolute w-full min-h-[2.5rem] flex justify-between items-center px-3">
                                                <span class="relative flex items-center justify-start gap-1 text-sm font-medium">
                                                    @if ($responseExists->option_id === $option->id)
                                                        <span class="relative w-fit h-fit">
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
                                class="relative flex items-center justify-start w-full overflow-hidden border rounded-lg border-neutral-300">
                                    <button type="button"
                                        style="width: {{ array_key_exists($option->id, $response) ? round(($response[$option->id] / $totalResponses) * 100) : 0 }}%;"
                                        class="bg-neutral-300 cursor-default text-left transition duration-1000 text-neutral-700 flex justify-start items-start border-0 outline-0 w-full min-h-[2.5rem]">
                                        <span class="absolute w-full min-h-[2.5rem] flex justify-between items-center px-3">
                                            <span class="relative flex items-center justify-start gap-1 text-sm font-medium">
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
                    <div class="relative flex items-center justify-center w-full py-5 text-sm text-center text-neutral-600">
                        No options for this poll.
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-start gap-2 mt-3 text-sm text-neutral-500">
                @if ($users->count() > 0)
                    <div class="flex items-center justify-start -space-x-3">
                        @foreach ($users as $user)
                            <div style="background-image: url('{{ $user->image ? $user->image : asset('icons/default_user.svg') }}'); background-repeat: no-repeat; background-size: cover; background-position: center;"
                            class="border-2 border-white min-h-[2rem] min-w-[2rem] h-[2rem] w-[2rem] rounded-full">
                            </div>
                        @endforeach
                    </div>
                @endif

                <span>
                    Total Responses:
                    <span id="total-responses" class="font-bold">
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

                @if ($now->lt($endDate))
                    @if ($years > 0)
                    <span class="font-bold">{{ $years }} {{ $years === 1 ? 'year' : 'years' }} left</span>
                    @elseif ($months > 0)
                        <span class="font-bold">{{ $months }} {{ $months === 1 ? 'month' : 'months' }} left</span>
                    @elseif ($days > 0)
                        <span class="font-bold">{{ $days }} {{ $days === 1 ? 'day' : 'days' }} left</span>
                    @elseif ($hours > 0)
                        <span class="font-bold">{{ $hours }} {{ $hours === 1 ? 'hour' : 'hours' }} left</span>
                    @elseif ($minutes > 0)
                        <span class="font-bold">{{ $minutes }} {{ $minutes === 1 ? 'minute' : 'minutes' }} left</span>
                    @else
                        <span class="font-bold">Few seconds left</span>
                    @endif
                @else
                    <span class="font-bold">Ended {{ $endDate->diffForHumans() }}</span>
                @endif
            </div>
        </div>
    </div>
@endsection
