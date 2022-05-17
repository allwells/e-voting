@extends('layout.app')

@section('content')
    <div class="mt-16 pt-4 pb-20 relative px-6 sm:px-14 md:px-24 h-fit">
        <h1 class="text-xl cursor-default sm:text-2xl font-semibold dark:text-neutral-200">
            Election
        </h1>

        <div class="w-full mt-8">
            <form action="{{ route('elections') }}" method="post">
                @csrf

                {{-- election title and description inputs --}}
                <div class="form-input-group gap-4 flex justify-center sm:flex-row flex-col">

                    {{-- election title input --}}
                    <div class="md:w-6/12 w-full">
                        <label for="title" class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Title
                            <span class="text-red-500">*</span>
                        </label>
                        <input name="title" type="text" id="title"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter election title" required>

                        @error('title')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- election description input --}}
                    <div class="md:w-6/12 w-full">
                        <label for="description"
                            class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Description
                        </label>

                        <input name="description" type="text" id="description"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter election description">
                    </div>
                </div>


                {{-- election start and end dates inputs --}}
                <div class="form-input-group gap-4 mt-6 flex justify-center sm:flex-row flex-col">

                    {{-- election start date and time input --}}
                    <div class="flex md:w-6/12 w-full gap-2">
                        <div class="w-6/12">
                            <label for="start_date"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                Start Date
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="start_date" type="date" id="start_date"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="YY-mm-dd" required>

                            @error('start_date')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="w-6/12">
                            <label for="start_time"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                Start Time
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="start_time" type="time" id="start_time"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="HH:mm" required>

                            @error('start_time')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    {{-- election end date and time input --}}
                    <div class="flex md:w-6/12 w-full justify-start items-end gap-2">
                        <div class="w-6/12">
                            <label for="end_date"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                End Date
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="end_date" type="date" id="end_date"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="YY-mm-dd" required>

                            @error('end_date')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="w-6/12">
                            <label for="end_time"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                End Time
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="end_time" type="time" id="end_time"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="HH:mm" required>

                            @error('end_time')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- <h1 class="text-neutral-800 mt-8 text-sm sm:text-xl font-normal dark:text-neutral-300">
                    Candidates
                </h1>
                <div class="form-input-group gap-4 flex justify-center sm:flex-row flex-col">
                    candidate name input
                    <div class="md:w-6/12 w-full">
                        <label for="candidate_name"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input name="candidate_name" type="text" id="candidate_name"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Candidate's name">
                    </div>

                    candidate party input
                    <div class="md:w-6/12 w-full">
                        <label for="description"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                            Party
                        </label>

                        <input name="description" type="text" id="description"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Candidate's political party (if any)">
                    </div>
                </div> --}}

                {{-- submit button --}}
                <div class="w-full flex justify-end items-center mt-4">
                    <button type="submit"
                        class="text-white px-6 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                        <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create
                    </button>
                </div>

            </form>

            {{-- Upcoming elections will display here --}}
            <div class="upcoming-elections">
                <h1 class="text-neutral-800 mt-8 text-sm sm:text-xl font-normal dark:text-neutral-300">
                    Upcoming Elections
                </h1>

                @if ($elections->count() > 0)
                    <div class="flex flex-col justify-center items-start h-fit gap-4 mt-4">
                        @foreach ($elections as $election)
                            @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                <div
                                    class="w-full flex flex-col items-center bg-neutral-50 rounded-lg border shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
                                    <div class="pt-2 px-2 z-20 w-full flex justify-end items-center">
                                        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
                                            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                                                data-dropdown-placement="left-start"
                                                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
                                                type="button">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdownLeft"
                                                class="z-30 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-44 divide-neutral-100 rounded-md shadow-lg dark:bg-neutral-700">
                                                <ul class="text-sm text-left text-neutral-700 dark:text-neutral-200"
                                                    aria-labelledby="dropdownLeftButton">
                                                    <li class="p-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li class="pb-1.5 px-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z">
                                                                </path>
                                                            </svg>
                                                            Close Election
                                                        </a>
                                                    </li>
                                                    <li class="p-1.5 border-t dark:border-neutral-600">
                                                        <form action="{{ route('elections') }}" method="post"
                                                            class="w-full">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="border-0 transition duration-300 flex justify-start items-center w-full p-2 font-medium rounded-md text-red-500 hover:bg-red-100 dark:hover:text-red-300 dark:hover:bg-red-700">
                                                                <svg class="w-6 h-6 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                    </path>
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div
                                        class="-mt-7 flex flex-col justify-between items-start px-4 sm:px-6 leading-normal w-full">
                                        {{-- Election title --}}
                                        <h5 class="mb-2 text-lg sm:text-2xl font-bold text-neutral-900 dark:text-white">
                                            {{ $election->title }}
                                        </h5>

                                        {{-- Election description --}}
                                        <p
                                            class="mb-3 text-left font-light text-sm sm:text-lg text-neutral-700 dark:text-neutral-400 line-clamp-3 md:line-clamp-2 lg:line-clamp-none">
                                            {{ $election->description }}
                                        </p>
                                    </div>

                                    <div
                                        class="w-full flex flex-col sm:flex-row justify-end items-center gap-3 px-4 sm:px-6 py-6">
                                        <a href="{{ route('elections') }}"
                                            class="text-white px-6 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            View
                                            <svg class="w-5 h-5 ml-1 pt-0.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col justify-center items-center border rounded-lg p-4 text-center h-32 border-dashed mt-4 border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                        No upcoming election(s) at the moment.
                    </div>
                @endif
            </div>

            {{-- Opened elections will display here --}}
            <div class="opened-elections">
                <h1 class="text-neutral-800 mt-8 text-sm sm:text-xl font-normal dark:text-neutral-300">
                    Opened Elections
                </h1>

                @if ($elections->count() > 0)
                    <div class="flex flex-col justify-center items-start h-fit gap-4 mt-4">
                        @foreach ($elections as $election)
                            @if ($today->gt($election->start_date) && $today->lt($election->end_date))
                                <div
                                    class="w-full flex flex-col items-center bg-neutral-50 rounded-lg border shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
                                    <div class="pt-2 px-2 z-20 w-full flex justify-end items-center">
                                        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
                                            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                                                data-dropdown-placement="left-start"
                                                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
                                                type="button">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdownLeft"
                                                class="z-30 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-44 divide-neutral-100 rounded-md shadow-lg dark:bg-neutral-700">
                                                <ul class="text-sm text-left text-neutral-700 dark:text-neutral-200"
                                                    aria-labelledby="dropdownLeftButton">
                                                    <li class="p-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li class="pb-1.5 px-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z">
                                                                </path>
                                                            </svg>
                                                            Close Election
                                                        </a>
                                                    </li>
                                                    <li class="p-1.5 border-t dark:border-neutral-600">
                                                        <form action="{{ route('elections') }}" method="post"
                                                            class="w-full">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="border-0 transition duration-300 flex justify-start items-center w-full p-2 font-medium rounded-md text-red-500 hover:bg-red-100 dark:hover:text-red-300 dark:hover:bg-red-700">
                                                                <svg class="w-6 h-6 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                    </path>
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div
                                        class="-mt-7 flex flex-col justify-between items-start px-4 sm:px-6 leading-normal w-full">
                                        {{-- Election title --}}
                                        <h5 class="mb-2 text-lg sm:text-2xl font-bold text-neutral-900 dark:text-white">
                                            {{ $election->title }}
                                        </h5>

                                        {{-- Election description --}}
                                        <p
                                            class="mb-3 text-left font-light text-sm sm:text-lg text-neutral-700 dark:text-neutral-400 line-clamp-3 md:line-clamp-2 lg:line-clamp-none">
                                            {{ $election->description }}
                                        </p>
                                    </div>

                                    <div
                                        class="w-full flex flex-col sm:flex-row justify-end items-center gap-3 px-4 sm:px-6 py-6">
                                        <a href="{{ route('elections') }}"
                                            class="text-white px-6 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            View
                                            <svg class="w-5 h-5 ml-1 pt-0.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col justify-center items-center border rounded-lg p-4 text-center h-32 border-dashed mt-4 border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                        No opened election(s) at the moment.
                    </div>
                @endif
            </div>


            {{-- closed elections will display here --}}
            <div class="closed-elections">
                <h1 class="text-neutral-800 mt-8 text-sm sm:text-xl font-normal dark:text-neutral-300">
                    Closed Elections
                </h1>

                @if ($elections->count() > 0)
                    <div class="flex flex-col justify-center items-start h-fit gap-4 mt-4">
                        @foreach ($elections as $election)
                            @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                                <div
                                    class="w-full flex flex-col items-center bg-neutral-50 rounded-lg border shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
                                    <div class="pt-2 px-2 z-20 w-full flex justify-end items-center">
                                        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
                                            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                                                data-dropdown-placement="left-start"
                                                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
                                                type="button">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdownLeft"
                                                class="z-30 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-44 divide-neutral-100 rounded-md shadow-lg dark:bg-neutral-700">
                                                <ul class="text-sm text-left text-neutral-700 dark:text-neutral-200"
                                                    aria-labelledby="dropdownLeftButton">
                                                    <li class="p-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li class="pb-1.5 px-1.5">
                                                        <a href="{{ route('elections') }}"
                                                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z">
                                                                </path>
                                                            </svg>
                                                            Close Election
                                                        </a>
                                                    </li>
                                                    <li class="p-1.5 border-t dark:border-neutral-600">
                                                        <form action="{{ route('elections') }}" method="post"
                                                            class="w-full">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="border-0 transition duration-300 flex justify-start items-center w-full p-2 font-medium rounded-md text-red-500 hover:bg-red-100 dark:hover:text-red-300 dark:hover:bg-red-700">
                                                                <svg class="w-6 h-6 mr-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                    </path>
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <div
                                        class="-mt-7 flex flex-col justify-between items-start px-4 sm:px-6 leading-normal w-full">
                                        {{-- Election title --}}
                                        <h5 class="mb-2 text-lg sm:text-2xl font-bold text-neutral-900 dark:text-white">
                                            {{ $election->title }}
                                        </h5>

                                        {{-- Election description --}}
                                        <p
                                            class="mb-3 text-left font-light text-sm sm:text-lg text-neutral-700 dark:text-neutral-400 line-clamp-3 md:line-clamp-2 lg:line-clamp-none">
                                            {{ $election->description }}
                                        </p>
                                    </div>

                                    <div
                                        class="w-full flex flex-col sm:flex-row justify-end items-center gap-3 px-4 sm:px-6 py-6">
                                        <a href="{{ route('elections') }}"
                                            class="text-white px-6 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            View
                                            <svg class="w-5 h-5 ml-1 pt-0.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col justify-center items-center border rounded-lg p-4 text-center h-32 border-dashed mt-4 border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                        No previous election(s).
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
