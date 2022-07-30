@extends('layout.layout')

@section('title', 'Home')
@section('home-tab', auth()->user()->theme == 'dark' ? 'active-dark-home' : 'active-home')

@section('views')
    <div
        class="flex sm:p-5 p-4 pt-5 justify-between gap-4 md:gap-5 items-start min-h-screen w-full md:bg-transparent bg-white">
        <div class="h-full pt-16 md:block hidden">
            <div class="h-fit w-fit md:w-48 rounded-2xl bg-transparent">
                <ul style="color: #0000FF;" class="flex text-lg flex-col justify-start items-start gap-4">
                    <li class="w-full">
                        <a href="#" class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.home_icon style="width: 18px;" class="h-5 flex-shrink-0" />
                            Voices Home
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#" class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.information_icon style="width: 22px; height: 22px;" class="flex-shrink-0" />
                            About
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#" class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.questionmark_icon style="width: 24px; height: 24px;" class="flex-shrink-0" />
                            FAQ
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#" class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.support_icon style="width: 24px; height: 24px;" class="flex-shrink-0" />
                            Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- post feed section --}}
        <div
            class="flex-grow h-full rounded-2xl gap-5 flex flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-16">
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

            <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;" class="w-full">
            </div>
        </div>

        {{-- profile and lastest activity section --}}
        <div style="width: 352px !important;"
            class="h-full rounded-2xl gap-5 flex flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-16 pb-28">
            <div
                class="h-full w-full lg:flex hidden text-white flex-col gap-5 flex-grow rounded-2xl justify-start items-start">
                <div class="rounded-2xl w-full"
                    style="background-image:url('{{ asset('images/profile-bg.jpg') }}'); background-position:bottom; background-size:cover; min-height: 219px !important; max-height: 219px !important; height: 219px;">
                    <div class="w-full h-full p-3 bg-black/50 pb-5 flex justify-center items-end rounded-2xl">
                        <div class="flex justify-center items-center gap-5">
                            <div class="flex flex-col justify-center items-center">
                                <h1 class="text-lg font-semibold">123k</h1>
                                <span class="text-xs font-normal">Followers</span>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <img src="{{ asset('images/profile.jpg') }}" alt=" profile image"
                                    class="rounded-full shadow-lg shadow-black/30 md:h-24 md:w-24 flex-shrink-0" />
                                <h1 class="text-base font-semibold mt-1">Tim Cook</h1>
                                <span style="font-size: 10px;" class="hover:underline hover:cursor-pointer">@tim202</span>
                            </div>

                            <div class="flex flex-col justify-center items-center">
                                <h1 class="text-lg font-semibold">4k</h1>
                                <span class="text-xs font-normal">Following</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white w-full min-h-fit rounded-xl p-5 flex flex-col justify-start items-start gap-3">
                    <h3 style="color: #555555;" class="text-xs">Latest Activity</h3>

                    <div
                        class="w-full text-neutral-700 text-sm flex flex-col scrollbar-hide scroll-smooth overflow-y-scroll">
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                        <x-activity_card />
                    </div>
                </div>

                <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;"
                    class="w-full">
                </div>
            </div>
        </div>
    </div>
@endsection
