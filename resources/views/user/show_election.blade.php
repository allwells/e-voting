@extends('user.home')

@section('title', $election->title)

@php
$now = \Carbon\Carbon::now();
$endDate = \Carbon\Carbon::parse($election->end_date);
$startDate = \Carbon\Carbon::parse($election->start_date);

$seconds = $endDate->diffInSeconds($now);
$minutes = $endDate->diffInMinutes($now);
$hours = $endDate->diffInHours($now);
$days = $endDate->diffInDays($now);
$months = $endDate->diffInMonths($now);
$years = $endDate->diffInYears($now);

$seconds2 = $startDate->diffInSeconds($now);
$minutes2 = $startDate->diffInMinutes($now);
$hours2 = $startDate->diffInHours($now);
$days2 = $startDate->diffInDays($now);
$months2 = $startDate->diffInMonths($now);
$years2 = $startDate->diffInYears($now);
@endphp

@section('home-page')
    <div
        class="flex flex-col items-start justify-start w-full gap-4 text-justify md:bg-white min-h-fit rounded-2xl lg:max-w-3xl">

        <div class="px-3 absolute w-full max-w-[44rem] z-10">
            <x-error_message />
            <x-info_message />
            <x-success_message />
        </div>

        <div class="w-full min-h-[218px] flex justify-start items-start flex-col overflow-hidden rounded-2xl"
            style="background-image: url('{{ asset('images/profile-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <div class="flex flex-col relative items-start justify-start w-full h-full bg-black/50">
                <div class="absolute mt-3 ml-3">
                    <a href="{{ url()->previous() }}"
                        class="flex justify-center items-center text-white font-bold text-xs p-1 rounded-md hover:bg-white/20">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Back
                    </a>
                </div>

                <div class="flex flex-col items-center justify-center w-full h-full text-white">
                    <h1 class="font-bold text-center md:text-4xl text-2xl">{{ $election->title }}</h1>
                    <p class="mt-1 text-sm font-normal text-center">
                        {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }} -
                        {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                    </p>

                    @if ($election->location)
                        <h3 class="text-base font-bold text-center mt-7">
                            {{ $election->location }}
                        </h3>
                    @endif
                </div>
            </div>

            @if (auth()->user()->privilege == 'admin' && $election->type == 'private')
                <div class="z-10 -mt-12 ml-3.5">
                    <button type="button" id="electionInfoButton" data-dropdown-toggle="electionInfo"
                        data-dropdown-placement="right"
                        class="hover:bg-white/10 focus:bg-white/20 text-white transition duration-300 rounded-full p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>

                    <div id="electionInfo"
                        class="hidden z-10 w-full min-w-[17rem] max-w-[17rem] bg-white rounded-xl shadow-lg">
                        <div class="p-4 text-sm text-neutral-700 w-full flex flex-col gap-3 justify-start items-start"
                            aria-labelledby="electionInfoButton">
                            <div class="flex gap-2 justify-start items-center">
                                <span>Created:</span>
                                <span>{{ date('d F, Y', strtotime(str_replace('-', '', substr($election->created_at, 0, 10)))) }}</span>
                            </div>

                            <div class="flex gap-2 justify-start items-center">
                                <span>Election Code:</span>
                                <span class="text-[#0000FF] font-bold">{{ $election->accessCode }}</span>
                            </div>

                            <div class="flex gap-2 justify-start items-center">
                                <span>Code Status:</span>
                                @if ($election->codeStatus == 'active')
                                    <span
                                        class="text-green-700 text-xs uppercase font-bold">{{ $election->codeStatus }}</span>
                                @else
                                    <span
                                        class="text-red-700 text-xs uppercase font-bold">{{ $election->codeStatus }}</span>
                                @endif

                                <form action="{{ route('activation', $election) }}" method="POST">
                                    @csrf

                                    <button type="submit">
                                        @if ($election->codeStatus == 'active')
                                            <span
                                                class="text-white text-xs bg-red-700 font-bold rounded p-1">Deactivate</span>
                                        @else
                                            <span
                                                class="text-white text-xs bg-green-700 font-bold rounded p-1">Activate</span>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="w-full px-3 md:px-5">
            <p class="text-xs">{{ $election->description }}</p>

            <div class="flex items-start justify-start sm:justify-end w-full gap-5 mt-3">
                <div class="text-[#0000FF] w-fit h-fit flex flex-col items-center justify-start">
                    <p class="text-xs font-semibold">Votes</p>
                    <p class="text-2xl font-bold">{{ $votes->count() }}</p>
                </div>

                <div class="text-[#0000FF] w-fit h-fit flex flex-col items-center justify-start">
                    @if ($hasStarted)
                        @if ($years > 0)
                            <p class="text-xs font-semibold">Voting closes in</p>
                            <p class="text-2xl font-bold">{{ $years }} {{ $years == 1 ? 'year' : 'years' }}</p>
                        @elseif ($months > 0)
                            <p class="text-xs font-semibold">Voting closes in</p>
                            <p class="text-2xl font-bold">{{ $months }} {{ $months == 1 ? 'month' : 'months' }}</p>
                        @elseif ($days > 0)
                            <p class="text-xs font-semibold">Voting closes in</p>
                            <p class="text-2xl font-bold">{{ $days }} {{ $days == 1 ? 'day' : 'days' }}</p>
                        @elseif ($hours > 0)
                            <p class="text-xs font-semibold">Voting closes in</p>
                            <p class="text-2xl font-bold">{{ $hours }} {{ $hours == 1 ? 'hour' : 'hours' }}</p>
                        @elseif ($minutes > 0)
                            <p class="text-xs font-semibold">Voting closes in</p>
                            <p class="text-2xl font-bold">{{ $minutes }} {{ $minutes == 1 ? 'minute' : 'minutes' }}
                            </p>
                        @else
                            <p class="text-sm font-bold">Voting closes in few seconds</p>
                        @endif
                    @elseif ($hasNotStarted)
                        @if ($years2 > 0)
                            <p class="text-xs font-semibold">Voting opens in</p>
                            <p class="text-2xl font-bold">{{ $years2 }} {{ $years2 == 1 ? 'year' : 'years' }}</p>
                        @elseif ($months2 > 0)
                            <p class="text-xs font-semibold">Voting opens in</p>
                            <p class="text-2xl font-bold">{{ $months2 }} {{ $months2 == 1 ? 'month' : 'months' }}</p>
                        @elseif ($days2 > 0)
                            <p class="text-xs font-semibold">Voting opens in</p>
                            <p class="text-2xl font-bold">{{ $days2 }} {{ $days2 == 1 ? 'day' : 'days' }}</p>
                        @elseif ($hours2 > 0)
                            <p class="text-xs font-semibold">Voting opens in</p>
                            <p class="text-2xl font-bold">{{ $hours2 }} {{ $hours2 == 1 ? 'hour' : 'hours' }}</p>
                        @elseif ($minutes2 > 0)
                            <p class="text-xs font-semibold">Voting opens in</p>
                            <p class="text-2xl font-bold">{{ $minutes2 }} {{ $minutes2 == 1 ? 'minute' : 'minutes' }}
                            </p>
                        @else
                            <p class="text-sm font-bold">Voting opens in few seconds</p>
                        @endif
                    @else
                        <p class="text-sm font-bold">Voting closed
                            {{ \Carbon\Carbon::create($election->end_date)->diffForHumans() }}</p>
                    @endif
                </div>
            </div>

            <h1 class="text-3xl mt-2 text-[#0000FF] font-bold">Candidates</h1>
            <div class="grid w-full grid-cols-1 gap-2 mt-2 sm:grid-cols-2">
                @foreach ($candidates as $candidate)
                    @if ($election->id === $candidate->election_id)
                        <x-candidate_card :today="$today" :candidate="$candidate" :election="$election" :winner="$winner"
                            :hasEnded="$hasEnded" :hasNotStarted="$hasNotStarted" />
                    @endif
                @endforeach
            </div>
        </div>

        @if ($election->type == 'private' && auth()->user()->privilege == 'admin')
            @if ($today->lt($election->start_date))
                <div class="w-full px-3 md:px-5 relative">
                    <form action="{{ route('import.file', $election) }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col justify-start items-start gap-2">
                        @csrf

                        <label class="block text-sm font-bold text-neutral-800" for="imported_file">
                            Import Participants
                        </label>

                        <div class="flex justify-end items-center flex-grow w-full">
                            <input type="file" name="imported_file" id="imported_file"
                                class="w-full px-3 flex-grow text-sm transition duration-300 border cursor-pointer border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-10 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                required />

                            <button type="submit"
                                class="flex justify-center items-center gap-1 bg-[#0000FF] p-1.5 mr-1 absolute rounded-md shadow-md hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="text-xs text-neutral-600">

                        </span>
                    </form>
                </div>
            @endif
        @endif

        <div
            class="md:bg-[#0000FF] md:rounded-br-2xl h-[80px] md:rounded-bl-2xl px-5 w-full flex justify-end items-center">
            @if ($hasEnded)
                <a href="{{ route('results.view', $election) }}" title="View election results"
                    class="h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg md:hover:bg-white text-base md:bg-white/90 border border-transparent font-semibold md:focus:ring md:focus:ring-white/50 md:focus:bg-white bg-[#0000FF] hover:bg-[#0000CC] focus:bg-[#0000CC] focus:ring focus:ring-[#0000FF]/30">
                    View Insights
                </a>
            @elseif ($hasNotStarted)
                <button type="button" title="This election has not started" disabled
                    class="h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg text-base md:bg-white/70 border border-transparent font-semibold bg-[#0000FF]/70">
                    View Insights
                </button>
            @else
                <button type="button" title="Wait for election to end" disabled
                    class="h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg text-base md:bg-white/70 border border-transparent font-semibold bg-[#0000FF]/70">
                    View Insights
                </button>
            @endif
        </div>
    </div>
@endsection
