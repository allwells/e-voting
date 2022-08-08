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

            @yield('home-page')

            <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;" class="w-full">
            </div>
        </div>

        {{-- profile and lastest activity section --}}
        <div
            class="h-full rounded-2xl gap-5 w-[352px] min-w-[352px] max-w-[352px] lg:flex hidden flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-16 pb-28">
            <div class="h-full w-full flex text-white flex-col gap-5 flex-grow rounded-2xl justify-start items-start">
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
