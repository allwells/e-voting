@extends('layout.layout')

@section('title', $election->title)
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

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

@section('views')
    <div class="flex flex-col items-start justify-start w-full gap-4 text-justify md:bg-white min-h-fit rounded-2xl">

        <div class="px-3 absolute w-full max-w-[61.8rem] z-10">
            <x-error_message />
            <x-info_message />
            <x-success_message />
        </div>

        <div class="w-full min-h-[218px] flex justify-start items-start flex-col overflow-hidden rounded-2xl"
            style="background-image: url('{{ asset('images/profile-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <div class="flex flex-col relative items-start justify-start w-full min-h-[218px] h-[218px] bg-black/50">
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

                @if (auth()->user()->privilege == 'superuser')
                    <div class="w-full flex justify-end items-center px-3">
                        <a href="{{ route('elections.edit', $election) }}" title="Edit this election"
                            class="hover:bg-white/20 rounded-md text-white p-1 mb-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                </path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            @if (auth()->user()->privilege == 'superuser' && $election->type == 'private')
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
                                <span>Election Type:</span>
                                @if ($election->type == 'private')
                                    <span class="text-xs uppercase font-bold text-red-600">private</span>
                                @endif

                                @if ($election->type == 'public')
                                    <span class="text-xs uppercase font-bold text-green-600">public</span>
                                @endif
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

        @if ($election->type == 'private' && auth()->user()->privilege == 'superuser')
            @if ($today->lt($election->start_date))
                <div class="w-full sm:p-6">
                    <label class="text-neutral-700 font-bold sm:block hidden text-base">Send Invite</label>

                    <div class="w-full relative sm:border sm:rounded-xl sm:p-6 mt-3">
                        <label class="text-neutral-700 font-bold text-sm uppercase">Send invite manually</label>

                        <form action="{{ route('invite', $election) }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="w-full">
                                    <input type="text" name="fname" id="fname" placeholder="First name"
                                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]"
                                        required />
                                </div>

                                <div class="w-full">
                                    <input type="text" name="lname" id="lname" placeholder="Last name"
                                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]"
                                        required />
                                </div>

                                <div class="w-full">
                                    <input type="email" name="email" id="email" placeholder="Email address"
                                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]"
                                        required />
                                </div>
                            </div>

                            <div class="flex justify-end items-center mt-5">
                                <button type="submit"
                                    class="w-full sm:w-fit py-2.5 px-5 text-sm font-bold text-white rounded-md bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 flex justify-center items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Send Invite
                                </button>
                            </div>
                        </form>

                        <div class="w-full flex justify-between items-center gap-3 mt-8 mb-4">
                            <div class="border-b border-dashed flex-grow border-neutral-300"></div>
                            <span class="text-lg font-bold uppercase text-neutral-400">Or</span>
                            <div class="border-b border-dashed flex-grow border-neutral-300"></div>
                        </div>

                        <label class="text-neutral-700 font-bold text-sm uppercase mb-5">
                            Upload list of users to send invites
                        </label>

                        <div class="w-full mb-3">
                            <h3 class="text-neutral-800 text-sm">
                                File Format: <span class="font-bold">.csv</span>, <span class="font-bold">.xlsx</span>,
                                and
                                <span class="font-bold">.xls</span> only.
                            </h3>

                            <div class="mt-3">
                                <h3 class="font-semibold text-neutral-700 text-sm">
                                    Valid Inputs:
                                </h3>
                                <ul class="mb-3 list-disc pl-4 text-sm text-neutral-700">
                                    <li>First Name</li>
                                    <li>Last Name</li>
                                    <li>Email</li>
                                </ul>

                                <h3 class="mb-2 text-neutral-700 text-sm">
                                    The user inputs are extracted as shown in the image below.
                                </h3>
                                <img src="{{ asset('images/file_upload_format.png') }}" alt="file upload format image"
                                    height="100" />
                            </div>
                        </div>

                        <form action="{{ route('users.file-import') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col justify-start items-start gap-2 mt-6">
                            @csrf

                            <label for="imported_file" class="text-sm font-medium text-neutral-600">
                                File to upload
                                <span class="text-rose-500">*</span>
                            </label>

                            <div class="flex justify-end items-center flex-grow w-full">
                                <input type="file" name="imported_file" id="imported_file"
                                    class="w-full px-3 flex-grow text-sm transition duration-300 border cursor-pointer border-neutral-100 rounded-lg placeholder-neutral-400 bg-neutral-100 h-10 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                    required />

                                <button type="submit"
                                    class="flex justify-center items-center gap-1 bg-[#0000FF] py-1.5 px-2 mr-1 absolute rounded-md shadow-md hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 text-white text-sm font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        @endif

        <div
            class="md:bg-[#0000FF] md:rounded-br-2xl h-[80px] md:rounded-bl-2xl sm:px-5 w-full flex justify-end items-center">
            @if ($hasEnded)
                <a href="{{ route('results.view', $election) }}" title="View election results"
                    class="w-full sm:w-fit h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg md:hover:bg-white text-base md:bg-white/90 border border-transparent font-semibold md:focus:ring md:focus:ring-white/50 md:focus:bg-white bg-[#0000FF] hover:bg-[#0000CC] focus:bg-[#0000CC] focus:ring focus:ring-[#0000FF]/30">
                    View Insights
                </a>
            @elseif ($hasNotStarted)
                <button type="button" title="This election has not started" disabled
                    class="w-full sm:w-fit h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg text-base md:bg-white/70 border border-transparent font-semibold bg-[#0000FF]/50">
                    View Insights
                </button>
            @else
                <button type="button" title="Wait for election to end" disabled
                    class="w-full sm:w-fit h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg text-base md:bg-white/70 border border-transparent font-semibold bg-[#0000FF]/50">
                    View Insights
                </button>
            @endif
        </div>
    </div>
@endsection
