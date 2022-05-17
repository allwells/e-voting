@extends('layout.app')

@section('content')
    <div class="user-dashboard mt-20 pb-10 px-4 sm:px-12 h-fit">
        <h1 class="text-neutral-800 text-md sm:text-3xl font-semibold dark:text-neutral-300">Dashboard</h1>

        @if ((auth() && auth()->user()->privilege == 'superuser') || (auth() && auth()->user()->privilege == 'admin'))
            <div class="flex flex-col sm:flex-row mt-4 gap-4">
                <div
                    class="flex flex-col justify-center items-center w-full sm:w-2/6 py-6 px-6 bg-white rounded-xl border border-neutral-200 shadow-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <h5
                        class="mb-2 cursor-default uppercase font-normal text-xs sm:text-sm tracking-tight text-neutral-700 dark:text-neutral-50">
                        Total Users
                    </h5>
                    <span class="dark:text-neutral-500 cursor-default font-bold text-3xl">{{ $users->count() }}</span>
                </div>

                @if (auth() && auth()->user()->privilege == 'superuser')
                    <div
                        class="flex flex-col justify-center items-center w-full sm:w-2/6 py-6 px-6 bg-white rounded-xl border border-neutral-200 shadow-xl dark:bg-neutral-800 dark:border-neutral-700">
                        <h5
                            class="mb-2 cursor-default uppercase font-normal text-xs sm:text-sm tracking-tight text-neutral-700 dark:text-neutral-50">
                            Total Admins
                        </h5>
                        <span class="dark:text-neutral-500 cursor-default font-bold text-3xl">{{ $admins->count() }}</span>
                    </div>
                @endif

                <div
                    class="flex flex-col justify-center items-center w-full sm:w-2/6 py-6 px-6 bg-white rounded-xl border border-neutral-200 shadow-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <h5
                        class="mb-2 cursor-default uppercase font-normal text-xs sm:text-sm tracking-tight text-neutral-700 dark:text-neutral-50">
                        Total Elections
                    </h5>
                    <span class="dark:text-neutral-500 cursor-default font-bold text-3xl">{{ $elections->count() }}</span>
                </div>
            </div>
        @endif

        <div class="mt-5 flex flex-col sm:flex-row gap-4">

            <a href="{{ route('users') }}"
                class="flex flex-row sm:flex-col justify-start sm:justify-center items-center hover:scale-105 transition duration-300 w-full sm:w-fit py-2 px-3 sm:py-6 sm:px-16 bg-white rounded-xl border border-neutral-200 shadow-xl dark:bg-neutral-800 dark:border-neutral-700">
                <span
                    class="bg-neutral-100 dark:bg-neutral-700 dark:border-neutral-600 p-3 mr-2 sm:mr-0 sm:mb-2 rounded-full border">
                    <svg class="flex-shrink-0 w-8 h-8 text-neutral-800 dark:text-neutral-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </span>
                <h5 class="mb-2 text-lg sm:text-2xl font-bold text-center text-neutral-700 dark:text-neutral-50">
                    Users
                </h5>
            </a>

            <a href="{{ route('elections') }}"
                class="flex flex-row sm:flex-col justify-start sm:justify-center items-center hover:scale-105 transition duration-300 w-full sm:w-fit py-2 px-3 sm:py-6 sm:px-16 bg-white rounded-xl border border-neutral-200 shadow-xl dark:bg-neutral-800 dark:border-neutral-700">
                <span
                    class="bg-neutral-100 dark:bg-neutral-700 dark:border-neutral-600 p-3 mr-2 sm:mr-0 sm:mb-2 rounded-full border">
                    <svg class="flex-shrink-0 w-8 h-8 text-neutral-800 dark:text-neutral-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                        </path>
                    </svg>
                </span>
                <h5 class="mb-2 text-lg sm:text-2xl font-bold text-center text-neutral-700 dark:text-neutral-50">
                    Elections
                </h5>
            </a>

        </div>
    </div>
@endsection
