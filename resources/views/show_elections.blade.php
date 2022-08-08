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
        class="md:bg-white w-full min-h-fit rounded-2xl text-justify flex flex-col gap-4 lg:max-w-3xl justify-start items-start ">
        <div class="w-full min-h-[218px] overflow-hidden rounded-2xl"
            style="background-image: url('{{ asset('images/profile-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="w-full h-full bg-black/50 flex justify-center flex-col items-center text-white">
                <h1 class="md:text-4xl font-bold 2text-xl text-center">{{ $election->title }}</h1>
                <p class="text-sm font-normal mt-1 text-center">
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }} -
                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                </p>

                <h3 class="text-base font-bold mt-7 text-center">
                    Port Harcourt, Nigeria
                </h3>
            </div>
        </div>

        <div class="md:px-5 w-full">
            <p class="text-xs">{{ $election->description }}</p>

            <div class="w-full flex justify-end items-start gap-5 mt-3">
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
            <div class="w-full mt-2 grid grid-cols-2 gap-2">
                @foreach ($candidates as $candidate)
                    @if ($election->id === $candidate->election_id)
                        <x-candidate_card :candidate="$candidate" :election="$election" />
                    @endif
                @endforeach
            </div>
        </div>

        <div class="bg-[#0000FF] rounded-br-2xl h-[80px] rounded-bl-2xl px-5 w-full flex justify-end items-center">
            <a href="#"
                class="h-[37px] py-1.5 px-5 text-[#0000FF] rounded-lg hover:bg-white text-base bg-white/90 border border-transparent font-semibold focus:ring focus:ring-white/50 focus:bg-white">
                View Insights
            </a>
        </div>
    </div>
@endsection
