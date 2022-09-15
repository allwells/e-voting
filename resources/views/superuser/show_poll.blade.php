@extends('layout.layout')

@section('title', $poll->title)
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div
        class="relative flex flex-col items-start justify-start w-full gap-5 text-justify md:bg-white min-h-fit rounded-2xl">

        <div class="relative w-full md:border md:p-5 rounded-2xl">
            <h1 class="text-lg font-medium text-neutral-700">{{ $poll->title }}</h1>

            <div class="relative flex flex-col items-start justify-start w-full gap-3 mt-3">
                @if ($options->count() > 0)
                    @foreach ($options as $option)
                        @if ($option->poll_id === $poll->id)
                        @if($now->lt($endDate))
                            @if (!$responseExists)
                                <form action="{{ route('polls.respond', [$poll->id, $option->id]) }}" method="POST"
                                    class="w-full">
                                    @csrf

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
    </div>
@endsection
