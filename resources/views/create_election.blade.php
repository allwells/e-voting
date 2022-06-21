@extends('layout.layout')

@section('title', 'Create Election')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="w-full bg-white gap-5 rounded-xl p-4 sm:px-5 sm:py-6 flex flex-col min-h-fit">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">Create Election</label>

        <form action="{{ route('elections.create') }}" method="POST" class="create-election-form flex flex-col gap-5">
            @csrf

            <div class="p-0 sm:px-5 sm:py-6 sm:border rounded-xl flex flex-col gap-2 sm:gap-5">
                <label class="text-neutral-600 font-medium text-sm">Election Details</label>

                <div
                    class="election-success-msg items-center justify-between hidden w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-normal border rounded cursor-default border-emerald-600 text-emerald-800 bg-emerald-200 h-fit">
                    <span class="election-message">Election created successfully!</span>
                    <span
                        class="close-election-success-msg p-1 transition duration-300 rounded-sm cursor-pointer text-emerald-700 hover:bg-emerald-400/50">
                        <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </span>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="title" class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            Title
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="title" type="text" id="title"
                            class="mt-1 w-full text-xs sm:text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent text-neutral-600  placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            placeholder="Enter election title" required>

                        @error('title')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="description"
                            class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            Description
                        </label>

                        <input name="description" type="text" id="description"
                            class="mt-1 w-full text-xs sm:text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent text-neutral-600  placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            placeholder="Enter election description">
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="start_date"
                            class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            Start Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="start_date" type="datetime-local" id="start_date"
                            class="mt-1 w-full text-xs sm:text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            required>

                        @error('start_date')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="end_date" class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            End Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="end_date" type="datetime-local" id="end_date"
                            class="mt-1 w-full text-xs sm:text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            required>
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="type" class="text-xs sm:text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            Election Type
                            <span class="text-rose-600">*</span>
                        </label>

                        <select name="type" type="combo" id="type"
                            class="mt-1 w-full text-xs sm:text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            required>
                            <option>-- Select election type --</option>
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                        </select>

                        @error('type')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full md:w-6/12"></div>
                </div>
            </div>

            <div class="p-0 sm:px-5 sm:py-6 sm:border rounded-xl flex flex-col gap-2 sm:gap-5">
                <label class="text-neutral-600 font-medium text-sm">Candidates</label>

                <div class="w-full overflow-y-auto overflow-x-auto">
                    <table class="w-full candidates-table">
                        <thead>
                            <tr class="border-y">
                                <th class="text-neutral-600 text-xs uppercase px-2 py-4 text-left">Candidate Name</th>
                                <th class="text-neutral-600 text-xs uppercase px-2 py-4 text-left">Candidate Party</th>
                                <th>
                                    <button type="button"
                                        class="w-fit p-0.5 text-white rounded-sm bg-indigo-600 shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300 add-candidate-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b candidates-table"></tbody>
                    </table>
                </div>
            </div>


            <div class="w-full flex justify-end items-center">
                <button type="submit"
                    class="w-full sm:w-fit py-2 px-8 text-sm font-normal text-white rounded-md bg-indigo-600 shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                    Create Election
                </button>
            </div>
        </form>
    </div>
@endsection
