@extends('layout.app')

@section('content')
    <div id="main-layout" class="flex items-start justify-between p-4 bg-neutral-100 h-screen user-dashboard">
        <x-sidebar />
        {{-- <x-mobile_menu /> --}}

        <div id="layout" class="flex flex-col w-full h-full bg-neutral-100 dark:bg-neutral-800">
            <div class="flex items-center justify-between ml-4 mb-2">
                <div class="flex items-center capitalize text-xl font-medium text-neutral-700">
                    <h1>@yield('title')</h1>
                </div>

                <div class="flex justify-end flex-grow gap-4">
                    {{-- <div class="flex items-center gap-2 px-4 py-2 rounded-md bg-neutral-50 text-neutral-600 w-fit">
                        <span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </span>
                        <span>{{ date('D F d, Y') }}</span> --}}
                    {{-- <span>{{ date('h:i:sa', strtotime(date('h:i:sa')) + 60 * 60) }}</span> --}}
                    {{-- </div> --}}

                    <div class="sm:flex items-center justify-center gap-3 p-1.5 cursor-default rounded-md bg-white hidden">
                        <a href="{{ route('profile') }}">
                            <div
                                class="flex items-center justify-center text-xl font-extrabold uppercase rounded-md hover:bg-neutral-200 h-11 w-11 text-neutral-500 bg-neutral-200/50">
                                {{ auth()->user()->fname[0] . auth()->user()->lname[0] }}
                            </div>
                        </a>
                        <div class="flex flex-col items-start justify-start text-base font-medium text-neutral-700">
                            <a href="{{ route('profile') }}" class="hover:underline">
                                <span>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</span>
                            </a>
                            <span class="text-xs font-normal text-neutral-500">{{ auth()->user()->email }}</span>
                        </div>
                        <div>
                            <button type="button" id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart"
                                data-dropdown-placement="left-start"
                                class="p-1 border-none rounded outline-none hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownLeftStart"
                                class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-44 dark:bg-neutral-700">
                                <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500"
                                    aria-labelledby="dropdownLeftStartButton">
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="flex items-center justify-start gap-2 p-2 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                            <span>
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center justify-start w-full gap-2 p-2 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                                <span>
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-full ml-4 overflow-y-auto pt-3">
                @yield('views')
            </div>
        </div>
    </div>
@endsection
