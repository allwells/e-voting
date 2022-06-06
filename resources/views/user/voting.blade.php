@extends('layout.layout')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-40">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Voting Area
            </h2>
            <div class="pb-6 mt-10 grow text-neutral-500 dark:text-neutral-200">
                @if ($candidates->count() > 0)
                    <div id="voting-success-msg"
                        class="items-center justify-between hidden w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-emerald-300 text-emerald-800 bg-emerald-200 h-fit">
                        <span id="voting-message"></span>
                        <span id="close-voting-success-msg"
                            class="p-1 text-white transition duration-300 rounded-sm cursor-pointer bg-emerald-600/60 hover:bg-emerald-700/90">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </span>
                    </div>

                    <div
                        class="flex flex-wrap items-start justify-start w-full h-full gap-4 mt-10 text-lg text-center text-neutral-500 dark:text-neutral-400">
                        @foreach ($candidates as $candidate)
                            <x-candidate_card :candidate="$candidate" :votes="$votes" :elections="$elections" />
                        @endforeach
                    </div>
                @else
                    <div class="w-full h-full mt-10 text-lg text-center text-neutral-500 dark:text-neutral-400">
                        Voting process has not begun.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
