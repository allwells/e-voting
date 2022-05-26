@extends('layout.layout')

@section('views')
    <div class="relative px-3 pt-6 pb-20 sm:px-14 md:px-16 h-fit">
        <h1 class="mb-4 text-lg font-semibold cursor-default sm:text-2xl dark:text-neutral-200">
            Create Election
        </h1>

        {{-- <div class="w-full mt-8">
            <div class="flex items-center justify-end w-full mb-4">
                <button
                    class="flex justify-center w-full px-4 py-2 text-sm font-semibold text-white transition duration-300 bg-indigo-700 border border-indigo-500 rounded shadow-lg sm:w-fit hover:bg-indigo-800 dark:bg-indigo-600 dark:hover:bg-indigo-700">
                    <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Election
                </button>
            </div> --}}

        @if ((auth() && auth()->user()->privilege == 'superuser') || (auth() && auth()->user()->privilege == 'admin'))
            {{-- <form action="{{ route('elections') }}" method="post" class="{{ $formVisibility ? "" : "hidden" }}"> --}}
            <form action="{{ route('elections') }}" method="post">
                @csrf

                {{-- election title and description inputs --}}
                <div class="flex flex-col justify-center gap-4 form-input-group sm:flex-row">

                    {{-- election title input --}}
                    <div class="w-full md:w-6/12">
                        <label for="title" class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Title
                            <span class="text-red-500">*</span>
                        </label>
                        <input name="title" type="text" id="title"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter election title" required>

                        @error('title')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- election description input --}}
                    <div class="w-full md:w-6/12">
                        <label for="description"
                            class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Description
                        </label>

                        <input name="description" type="text" id="description"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter election description">
                    </div>
                </div>


                {{-- election start and end dates inputs --}}
                <div class="flex flex-col justify-center gap-4 mt-6 form-input-group sm:flex-row">

                    {{-- election start date and time input --}}
                    <div class="flex w-full gap-2 md:w-6/12">
                        <div class="w-6/12">
                            <label for="start_date"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                Start Date
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="start_date" type="date" id="start_date"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
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
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="HH:mm" required>

                            @error('start_time')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    {{-- election end date and time input --}}
                    <div class="flex items-end justify-start w-full gap-2 md:w-6/12">
                        <div class="w-6/12">
                            <label for="end_date"
                                class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                                End Date
                                <span class="text-red-500">*</span>
                            </label>
                            <input name="end_date" type="date" id="end_date"
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
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
                                class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="HH:mm" required>

                            @error('end_time')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- submit button --}}
                <div class="flex items-center justify-end w-full mt-4">
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
        @endif

        <h1 class="mt-8 text-lg font-semibold cursor-default sm:text-2xl dark:text-neutral-200">
            Elections
        </h1>

        <div id="accordion-flush" data-accordion="collapse" class="flex flex-col gap-4 mt-4"
            data-active-classes="bg-white dark:bg-neutral-900 text-neutral-700 dark:text-white"
            data-inactive-classes="text-neutral-500 dark:text-neutral-400 dark:bg-neutral-700 dark:border-neutral-900">

            <h2 id="accordion-flush-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-left border rounded-md sm:text-lg sm:p-3 text-neutral-500 border-neutral-200 dark:border-neutral-700 dark:text-neutral-400 dark:bg-neutral-900"
                    data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                    aria-controls="accordion-flush-body-1">
                    <span>Upcoming Elections</span>
                    <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-1" class="mb-3" aria-labelledby="accordion-flush-heading-1">
                <div class="py-0">
                    @if ($elections->count() > 0)
                        <div class="flex flex-col items-start justify-center gap-4 mt-4 h-fit">
                            @foreach ($elections as $election)
                                @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                    <x-election_card :election="$election" :today="$today" />
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center h-32 p-4 mt-4 text-center border border-dashed rounded-lg border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                            No upcoming election(s) at the moment.
                        </div>
                    @endif
                </div>
            </div>

            <h2 id="accordion-flush-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-left border rounded-md sm:text-lg sm:p-3 text-neutral-500 border-neutral-200 dark:border-neutral-700 dark:text-neutral-400 dark:bg-neutral-900"
                    data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                    aria-controls="accordion-flush-body-2">
                    <span>Opened Elections</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                <div class="py-0">
                    @if ($elections->count() > 0)
                        <div class="flex flex-col items-start justify-center gap-4 mt-4 h-fit">
                            @foreach ($elections as $election)
                                @if ($today->gt($election->start_date) && $today->lt($election->end_date))
                                    <x-election_card :election="$election" :today="$today" />
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center h-32 p-4 mt-4 text-center border border-dashed rounded-lg border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                            No opened election(s) at the moment.
                        </div>
                    @endif
                </div>
            </div>

            <h2 id="accordion-flush-heading-3">
                <button type="button"
                    class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-left border rounded-md sm:text-lg sm:p-3 text-neutral-500 border-neutral-200 dark:border-neutral-700 dark:text-neutral-400 dark:bg-neutral-900"
                    data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                    aria-controls="accordion-flush-body-3">
                    <span>Closed Elections</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                <div class="py-0">
                    @if ($elections->count() > 0)
                        <div class="flex flex-col items-start justify-center gap-4 mt-4 h-fit">
                            @foreach ($elections as $election)
                                @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                                    <x-election_card :election="$election" :today="$today" />
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center h-32 p-4 mt-4 text-center border border-dashed rounded-lg border-neutral-500 text-neutral-600 dark:text-neutral-500 ">
                            No previous election(s).
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection