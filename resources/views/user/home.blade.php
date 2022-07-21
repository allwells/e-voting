@extends('layout.layout')

@section('title', 'Home')
@section('home-tab', auth()->user()->theme == 'dark' ? 'active-dark-home' : 'active-home')

@section('views')
    <div class="flex p-5 justify-between gap-5 items-start min-h-screen w-full">
        <div class="h-full pt-14">
            <div class="h-fit w-56 rounded-xl bg-white p-3">
                <ul class="text-blue-700 flex flex-col justify-start items-start gap-1">
                    <li class="w-full">
                        <a href="#"
                            class="flex justify-start items-center gap-2 w-full p-2 bg-white hover:bg-neutral-100 rounded-lg focus:ring focus:ring-black/20 transition duration-200">
                            <x-icons.home_icon class="h-6 w-6" />
                            Voices Home
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#"
                            class="flex justify-start items-center gap-2 w-full p-2 bg-white hover:bg-neutral-100 rounded-lg focus:ring focus:ring-black/20 transition duration-200">
                            <x-icons.information_icon class="h-6 w-6" />
                            About
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#"
                            class="flex justify-start items-center gap-2 w-full p-2 bg-white hover:bg-neutral-100 rounded-lg focus:ring focus:ring-black/20 transition duration-200">
                            <x-icons.questionmark_icon class="h-6 w-6" />
                            FAQ
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#"
                            class="flex justify-start items-center gap-2 w-full p-2 bg-white hover:bg-neutral-100 rounded-lg focus:ring focus:ring-black/20 transition duration-200">
                            <x-icons.support_icon class="h-6 w-6" />
                            Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- post feed section --}}
        <div
            class="flex-grow h-full rounded-xl gap-5 flex flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-14">
            <div class="w-full p-5 h-32 bg-white rounded-xl max-w-3xl">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id nostrum, deleniti aspernatur ipsa fugit
                molestiae itaque iusto corporis tempora nihil asperiores, autem doloremque voluptatem eligendi beatae porro
                enim necessitatibus atque autem doloremque voluptatem eligendi beatae porro
                enim necessitatibus atque?
            </div>

            <div class="w-full p-5 min-h-fit bg-white rounded-xl max-w-3xl text-justify flex flex-col gap-5">
                <div class="flex flex-col gap-3 justify-center items-center w-full">
                    <div class="flex justify-between items-center w-full">
                        <h2 class="text-xl text-neutral-800 font-semibold">Elections</h2>

                        <button id="electionOptionDropDown" data-dropdown-toggle="dropdown"
                            class="hover:bg-neutral-100 focus:ring focus:ring-black/20 text-blue-700 p-0.5 rounded-md">
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

                    <ul class="w-full flex justify-starty items-center gap-3 text-sm text-neutral-500">
                        <li><button type="button" id="ongoing" class="text-blue-700 font-semibold">Ongoing</button></li>
                        <li><button type="button" id="participated" class="hover:text-neutral-800">Participated</button>
                        </li>
                        <li><button type="button" id="recommended" class="hover:text-neutral-800">Recommended</button></li>
                    </ul>
                </div>

                <div class="flex flex-col gap-6">
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                    <x-election_card />
                </div>
            </div>
        </div>

        {{-- profile and lastest activity section --}}
        <div class="h-full pt-14 text-white w-72 flex flex-col gap-5 flex-grow rounded-xl justify-start items-start">
            <div class="bg-white rounded-xl w-full h-52"
                style="background-image:url('{{ asset('images/profile-bg.jpg') }}'); background-position:bottom; background-size:cover;">
                <div class="w-full h-full bg-black/50 pb-5 flex justify-center items-end rounded-xl">
                    <div class="flex justify-center items-center gap-5">
                        <div class="flex flex-col justify-center items-center">
                            <h1 class="text-lg font-semibold">123k</h1>
                            <span class="text-sm font-normal">Followers</span>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset('images/profile.jpg') }}" alt=" profile image"
                                class="h-20 w-20 rounded-lg shadow-lg shadow-black/30" />
                            <h1 class="text-lg font-semibold mt-1">Tim Cook</h1>
                            <span class="text-sm hover:underline hover:cursor-pointer">@tim202</span>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <h1 class="text-lg font-semibold">4k</h1>
                            <span class="text-sm font-normal">Following</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white w-full min-h-fit rounded-xl p-5 flex flex-col justify-start items-start gap-3">
                <h3 class="text-sm text-neutral-500">Latest Activity</h3>

                <div
                    class="w-full text-neutral-700 activities text-sm flex flex-col scrollbar-hide scroll-smooth overflow-y-scroll">
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                    <span>1Activity for today</span>
                </div>
            </div>
        </div>
    </div>
@endsection
