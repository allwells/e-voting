@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start justify-start h-full pr-5">
        <h3 class="text-lg font-medium text-neutral-800">Elections</h3>

        <div
            class="flex flex-col items-center justify-start w-full gap-5 mt-5 md:flex-row md:justify-between md:items-start">
            <div class="flex flex-col items-start justify-start w-full gap-5 pb-10 md:w-3/4">
                @foreach ($elections as $election)
                    <x-election_card :election="$election" />
                @endforeach

                <div class="w-full mt-3 text-neutral-800">
                    {{ $elections->links() }}
                </div>
            </div>

            <div class="w-full p-4 pb-6 bg-white border rounded-lg md:w-1/4 h-fit border-neutral-200">
                <h3 class="text-base font-medium text-neutral-800">Latest</h3>

                <div class="flex flex-col gap-3 mt-3">
                    @foreach ($latestElection as $latest)
                        <p class="px-2 py-3 text-sm rounded-md text-neutral-700 hover:underline bg-neutral-100">
                            {{ $latest->title }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
