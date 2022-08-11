@extends('layout.layout')

@section('title', 'Settings')

@section('views')
    <div
        class="flex sm:p-5 p-4 pt-5 justify-between gap-4 md:gap-5 items-start min-h-screen w-full md:bg-transparent bg-white">
        <div class="h-full pt-16 md:block hidden">
            <div class="h-fit w-fit md:w-48 rounded-2xl bg-transparent">
                <ul class="flex text-[#0000FF] text-lg flex-col justify-start items-start gap-4">
                    <li class="w-full">
                        <a href="{{ route('explore') }}"
                            class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="{{ route('settings.email') }}"
                            class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.email_setting />
                            Change Email
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="{{ route('settings.password') }}"
                            class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.password_setting />
                            Change Password
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="{{ route('settings.notification') }}"
                            class="flex justify-start items-center gap-2 w-full transition duration-200">
                            <x-icons.notification_setting />
                            Notifications
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="flex-grow h-full rounded-2xl gap-5 flex flex-col overflow-y-auto scrollbar-hide scroll-smooth justify-start items-start pt-16">

            @yield('settings-page')

            <div style="min-height: 25px !important; height: 25px !important; max-height: 25px !important;" class="w-full">
            </div>
        </div>
    </div>
@endsection
