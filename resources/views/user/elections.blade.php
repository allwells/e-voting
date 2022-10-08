@extends('user.home')

@section('title', 'Elections')

@section('home-page')
    <div class="flex flex-col w-full gap-5 px-2 bg-white rounded-xl sm:p-5">
        <h2 class="text-2xl md:text-3xl text-[#0000FF] font-bold">Previous Elections</h2>
        @if ($elections->count() > 0)
            <div class="flex flex-col w-full gap-5">
                @foreach ($elections as $election)
                    <x-election_card_2 :election="$election" />
                @endforeach
            </div>
        @else
            <span class="text-base text-neutral-500 tracking-tight font-medium">
                You have not participated in any election.
            </span>
        @endif
    </div>
@endsection
