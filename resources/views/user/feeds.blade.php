@extends('user.home')

@section('title', 'Explore')

@section('home-page')
    <div class="md:bg-white w-full md:p-5 min-h-fit rounded-2xl text-justify flex flex-col gap-5 md:pb-7 pb-16">

        <div class="absolute w-full top-20 max-w-[41.4rem] flex-grow">
            <x-error_message />
            <x-info_message />
            <x-success_message />
        </div>

        <div class="flex flex-col gap-3 justify-center items-center w-full">
            <div class="flex justify-between items-center  w-full">
                <h2 class="text-xl md:text-3xl font-semibold text-[#0000FF]">Elections</h2>

                <div class="flex justify-end items-center gap-2">
                    <button type="button" data-modal-toggle="election-code-modal"
                        class="flex items-center justify-center gap-1 rounded-xl px-3 py-2.5 text-xs text-white bg-[#0000FF] font-bold hover:bg-[#0000DD] active:scale-95">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Join Private Election
                    </button>
                    <x-election_code_modal />

                    @if (auth()->user()->privilege == 'admin')
                        <button id="eventOptionDropDown" data-dropdown-toggle="eventFeeds"
                            class="bg-neutral-100 hover:bg-neutral-200/80 focus:bg-neutral-200/50 border border-neutral-200/60 hover:border-neutral-300/80 focus:border-[#0000FF] focus:ring-0 p-1.5 rounded-xl text-[#0000FF]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                </path>
                            </svg>
                        </button>

                        <div id="eventFeeds" class="hidden z-10 w-44 bg-white rounded-xl shadow-lg border">
                            <ul class="text-sm text-neutral-600 p-2 gap-1.5 flex flex-col"
                                aria-labelledby="eventOptionDropDown">
                                <li>
                                    <a href="{{ route('elections.create') }}"
                                        class="rounded-xl px-3 py-2 hover:bg-neutral-100 hover:text-neutral-900 flex items-center justify-start gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <span class="hidden md:block">Create Election</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('polls.create') }}"
                                        class="rounded-xl px-3 py-2 hover:bg-neutral-100 hover:text-neutral-900 flex items-center justify-start gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <span class="hidden md:block">Create Poll</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            {{-- <ul class="w-full flex justify-starty items-center gap-3 text-xs text-neutral-500">
                <li><button type="button" id="ongoing" class="font-semibold text-[#0000FF]">All</button>
                </li>
                <li><button type="button" id="participated" class="hover:text-neutral-900">Ongoing</button>
                <li><button type="button" id="participated" class="hover:text-neutral-900">Participated</button>
                </li>
                <li><button type="button" id="recommended" class="hover:text-neutral-900">Recommended</button></li>
            </ul> --}}
        </div>

        <div class="flex flex-col gap-4 md:gap-6">
            @foreach ($elections as $election)
                <x-election_card :election="$election" :candidates="$candidates" :votes="$votes" :count="$count" />
            @endforeach
        </div>
    </div>
@endsection
