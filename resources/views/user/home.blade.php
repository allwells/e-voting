@extends('layout.layout')

@section('title', 'Home')
@section('home-tab', auth()->user()->theme == 'dark' ? 'active-dark-home' : 'active-home')

@section('views')
    <div
        class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 w-full min-h-screen gap-4 p-4 pt-5 bg-white sm:p-5 md:gap-5 md:bg-transparent">
        <div class="hidden h-full pt-16 md:block md:col-start-1 md:col-end-2">
            <div class="bg-transparent h-fit w-fit md:w-48 rounded-2xl">
                <ul style="color: #0000FF;" class="flex flex-col items-start justify-start gap-4 text-lg">
                    <li class="w-full">
                        <a href="https://voices.i-amvocal.org" target="_blank" class="flex items-center justify-start gap-2 w-fit">
                            <x-icons.home_icon style="width: 18px;" class="flex-shrink-0 h-5" />
                            Voices Home
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="https://voices.i-amvocal.org/about" target="_blank" rel="noreferrer" class="flex items-center justify-start gap-2 w-fit">
                            <x-icons.information_icon style="width: 22px; height: 22px;" class="flex-shrink-0" />
                            About
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#" class="flex items-center justify-start gap-2 w-fit">
                            <x-icons.questionmark_icon style="width: 24px; height: 24px;" class="flex-shrink-0" />
                            FAQs
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="#" class="flex items-center justify-start gap-2 w-fit">
                            <x-icons.support_icon style="width: 24px; height: 24px;" class="flex-shrink-0" />
                            Support
                        </a>
                    </li>

                    <li class="w-full">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-start w-full gap-2 transition duration-200">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- post feed section --}}
        <div
            class="flex flex-col items-start justify-start col-start-1 col-span-full md:col-start-2 lg:col-end-12 md:col-end-13 flex-grow h-full gap-5 pt-16 overflow-y-auto rounded-2xl scrollbar-hide scroll-smooth">

            @yield('home-page')

            <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;" class="w-full">
            </div>
        </div>

        {{-- profile and lastest activity section --}}
        <div
            class="h-full rounded-2xl gap-5 w-[352px] min-w-[300px] max-w-[352px] lg:col-start-12 lg:col-end-13 lg:flex hidden flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-16 pb-28">
            <div class="flex flex-col items-start justify-start flex-grow w-full h-full gap-5 text-white rounded-2xl">
                <div class="w-full rounded-2xl"
                    style="background-image:url('{{ asset('images/profile-bg.jpg') }}'); background-position:bottom; background-size:cover; min-height: 219px !important; max-height: 219px !important; height: 219px;">
                    <div class="flex items-end justify-center w-full h-full p-3 pb-5 bg-black/50 rounded-2xl">
                        <div class="flex items-center justify-center gap-5">
                            <div class="flex flex-col items-center justify-center">
                                <h1 class="text-lg font-semibold">123k</h1>
                                <span class="text-xs font-normal">Followers</span>
                            </div>

                            <div class="flex flex-col items-center justify-center">
                                @if (auth()->user()->image)
                                    <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->name }}"
                                        class="flex-shrink-0 rounded-full shadow-lg shadow-black/30 md:h-24 md:w-24" />
                                @else
                                    <svg class="flex-shrink-0 bg-black border-2 border-black rounded-full shadow-lg shadow-black/30 md:h-24 md:w-24"
                                        fill="currentColor" viewBox="2.2 2.2 15.6 15.6" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                <h1 class="mt-1 text-base font-semibold">Tim Cook</h1>
                                <span style="font-size: 10px;" class="hover:underline hover:cursor-pointer">@tim202</span>
                            </div>

                            <div class="flex flex-col items-center justify-center">
                                <h1 class="text-lg font-semibold">4k</h1>
                                <span class="text-xs font-normal">Following</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-start justify-start w-full gap-3 p-5 bg-white min-h-fit rounded-xl">
                    <h3 style="color: #555555;" class="text-xs">Latest Activity</h3>

                    <div
                        class="flex flex-col w-full pb-2 overflow-y-scroll text-sm text-neutral-700 scrollbar-hide scroll-smooth">
                        {{-- <x-activity_card /> --}}
                        <div class="py-8 text-sm font-medium text-center text-neutral-600">
                            No activity.
                        </div>
                    </div>
                </div>

                <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;"
                    class="w-full">
                </div>
            </div>
        </div>
    </div>
@endsection
