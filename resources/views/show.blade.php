@extends('layout.layout')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Election Details
            </h2>

            <div class="mt-4 text-sm cursor-default text-neutral-700 md:text-base">
                <a href="{{ route('elections') }}" class="text-indigo-600 cursor-pointer hover:underline">
                    Election
                </a>
                /
                <span class="text-neutral-400">Election Details</span>
            </div>

            <div class="pb-6 mt-6 cursor-default grow text-neutral-700 dark:text-neutral-200">
                {{-- Election details --}}
                <div>
                    <h2 class="text-lg font-bold uppercase sm:text-2xl">{{ $election->title }}</h2>

                    @if ($election->type == 'close')
                        <span
                            class="mt-2 flex w-fit items-center justify-center px-2 py-0.5 text-xs border-2 border-white text-blue-700 md:text-sm bg-blue-200 ring-1 ring-blue-200 dark:border-neutral-900">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            This is a <strong class="mx-1">close</strong> election!
                        </span>
                    @endif
                    <p class="mt-2 text-sm sm:text-base text-neutral-500">{{ $election->description }}</p>
                </div>

                {{-- Election candidates --}}
                <div class="flex flex-wrap items-start justify-start w-full gap-4 mt-10">
                    @foreach ($candidates as $candidate)
                        <x-candidate_card :votes="$votes" :hasVoted="$hasVoted" :election="$election" :candidate="$candidate" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
