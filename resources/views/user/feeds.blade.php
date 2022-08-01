@extends('user.home')

@section('title', 'Explore')

@section('home-page')
    <div class="md:bg-white w-full md:p-5 min-h-fit rounded-2xl text-justify flex flex-col gap-5 md:pb-7 pb-16">
        <div class="flex flex-col gap-3 justify-center items-center w-full">
            <div class="flex justify-between items-center  w-full">
                <h2 style="color: #0000FF;" class="text-3xl font-semibold">Elections</h2>

                <button id="electionOptionDropDown" data-dropdown-toggle="dropdown" style="color: #0000FF;"
                    class="hover:bg-neutral-100 focus:ring focus:ring-black/20 p-0.5 rounded-md">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                        </path>
                    </svg>
                </button>

                <div id="dropdown" class="hidden z-10 w-44 bg-white rounded-xl shadow-lg border">
                    <ul class="text-sm text-neutral-700 p-1.5 gap-1.5 flex flex-col"
                        aria-labelledby="electionOptionDropDown">
                        <li>
                            <a href="#" class="block rounded-lg p-3 hover:bg-neutral-100">
                                Option 1
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block rounded-lg p-3 hover:bg-neutral-100">
                                Option 2
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="w-full flex justify-starty items-center gap-3 text-xs text-neutral-500">
                <li><button type="button" id="ongoing" style="color: #0000FF;" class="font-semibold">All</button>
                </li>
                <li><button type="button" id="participated" class="hover:text-neutral-900">Ongoing</button>
                <li><button type="button" id="participated" class="hover:text-neutral-900">Participated</button>
                </li>
                <li><button type="button" id="recommended" class="hover:text-neutral-900">Recommended</button></li>
            </ul>
        </div>

        <div class="flex flex-col gap-4 md:gap-6">
            @foreach ($elections as $election)
                <x-election_card :election="$election" :candidates="$candidates" :votes="$votes" :count="$count" />
            @endforeach
        </div>
    </div>
@endsection
