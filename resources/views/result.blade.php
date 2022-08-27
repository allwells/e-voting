@extends('user.home')

@section('title', 'Election Results')

@section('home-page')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        <h2 class="text-xl md:text-3xl text-[#0000FF] font-bold">Election Results</h2>
        @if ($elections->count() > 0)
            <div class="flex flex-col w-full gap-5">
                @foreach ($elections as $election)
                    <x-result_card :election="$election" />
                @endforeach
            </div>
        @else
            <div class="w-full py-5 flex justify-center items-center">
                <span class="text-base text-neutral-500 tracking-wider">No results.</span>
            </div>
        @endif
    </div>
@endsection
