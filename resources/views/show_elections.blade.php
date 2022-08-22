@extends('user.home')

@section('title', $election->title)

@php
$now = \Carbon\Carbon::now();
$date = \Carbon\Carbon::parse($election->end_date);

$years = $date->diffInYears($now);
$months = $date->diffInMonths($now);
$days = $date->diffInDays($now);
$hours = $date->diffInHours($now);
$minutes = $date->diffInMinutes($now);
$seconds = $date->diffInSeconds($now);
@endphp

@section('home-page')
    <div
        class="flex flex-col items-start justify-start w-full gap-4 text-justify md:bg-white min-h-fit rounded-2xl lg:max-w-3xl">

        <div class="px-3 absolute w-full max-w-[44rem]">
            <x-error_message />
            <x-info_message />
            <x-success_message />
        </div>

        <div class="w-full min-h-[218px] overflow-hidden rounded-2xl"
            style="background-image: url('{{ asset('images/profile-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="flex flex-col items-center justify-center w-full h-full text-white bg-black/50">
                <h1 class="font-bold text-center md:text-4xl 2text-xl">{{ $election->title }}</h1>
                <p class="mt-1 text-sm font-normal text-center">
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }} -
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                </p>

                <h3 class="text-base font-bold text-center mt-7">
                    Port Harcourt, Nigeria
                </h3>
            </div>
        </div>

        <div class="w-full px-3 md:px-5">
            <p class="text-xs">{{ $election->description }}</p>

            <div class="flex items-start justify-start sm:justify-end w-full gap-5 mt-3">
                <div class="text-[#0000FF] w-fit h-fit flex flex-col items-center justify-start">
                    <p class="text-xs font-semibold">Votes</p>
                    <p class="text-2xl font-bold">{{ $votes->count() }}</p>
                </div>

                <div class="text-[#0000FF] w-fit h-fit flex flex-col items-center justify-start">
                    @if (!($now->gt($election->start_date) && $now->gt($election->end_date)))
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
                            :isEnded="$isEnded" :notStarted="$notStarted" />
                    @endif
                @endforeach
            </div>
        </div>

        <div class="md:bg-[#0000FF] md:rounded-br-2xl h-[80px] md:rounded-bl-2xl px-5 w-full flex justify-end items-center">
            @if (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
                <a href="{{ route('results.view', $election) }}" title="View election results"
                    class="h-[37px] py-1.5 px-5 text-white md:text-[#0000FF] rounded-lg md:hover:bg-white text-base md:bg-white/90 border border-transparent font-semibold md:focus:ring md:focus:ring-white/50 md:focus:bg-white bg-[#0000FF] hover:bg-[#0000CC] focus:bg-[#0000CC] focus:ring focus:ring-[#0000FF]/30">
                    View Insights
                </a>
            @elseif ($today->lt($election->start_date) && $today->lt($election->end_date))
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
