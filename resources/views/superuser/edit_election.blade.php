@extends('layout.layout')

@section('title', 'Edit Election')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:px-5 sm:py-6 min-h-fit">
        <label class="text-sm font-medium text-neutral-600 sm:text-base">Edit Election</label>

        <form action="{{ route('elections.edit', $election->id) }}" method="POST"
            class="flex flex-col gap-5 create-election-for">
            @csrf

            <div class="flex flex-col gap-2 p-0 sm:px-5 sm:py-6 sm:border rounded-xl sm:gap-5">
                <label class="text-sm font-medium text-neutral-600">Election Details</label>

                <div
                    class="election-success-msg items-center justify-between hidden w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-normal border rounded cursor-default border-emerald-600 text-emerald-800 bg-emerald-200 h-fit">
                    <span class="election-message">Election updated successfully!</span>
                    <span
                        class="p-1 transition duration-300 rounded-sm cursor-pointer close-election-success-msg text-emerald-700 hover:bg-emerald-400/50">
                        <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </span>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="title" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Title
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="title" type="text" id="title"
                            class="w-full px-3 mt-1 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            placeholder="Enter election title" value="{{ $election->title }}" required>

                        @error('title')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="description"
                            class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Description
                        </label>

                        <input name="description" type="text" id="description"
                            class="w-full px-3 mt-1 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            placeholder="Enter election description" value="{{ $election->description }}">
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="start_date"
                            class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Start Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="start_date" type="datetime-local" id="start_date"
                            class="w-full px-3 mt-1 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            value="{{ $election->start_date }}" required>

                        @error('start_date')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="end_date" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            End Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="end_date" type="datetime-local" id="end_date"
                            class="w-full px-3 mt-1 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            value="{{ $election->end_date }}" required>
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="type" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Election Type
                            <span class="text-rose-600">*</span>
                        </label>

                        <select name="type" type="combo" id="type"
                            class="w-full px-3 mt-1 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                            required>
                            <option>-- Select election type --</option>
                            <option @if ($election->type == 'public') selected @endif value="public">Public</option>
                            <option @if ($election->type == 'private') selected @endif value="private">Private</option>
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

            <div class="flex flex-col gap-2 p-0 sm:px-5 sm:py-6 sm:border rounded-xl sm:gap-5">
                <label class="text-sm font-medium text-neutral-600">Candidates</label>

                <div class="w-full overflow-x-auto overflow-y-auto">
                    <table class="w-full candidates-table">
                        <thead>
                            <tr class="border-y">
                                <th class="px-2 py-4 text-xs text-left uppercase text-neutral-600">Candidate Name</th>
                                <th class="px-2 py-4 text-xs text-left uppercase text-neutral-600">Candidate Party</th>
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
                        <tbody class="border-b candidates-table">
                            @foreach ($candidates as $candidate)
                                <tr class="my-2">
                                    <td class="py-2">
                                        <div class="flex items-center justify-center px-2">
                                            <input name="name[]" type="text" id="name"
                                                class="w-full h-12 px-3 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                                                placeholder="Enter candidate's full name'" value="{{ $candidate->name }}"
                                                required>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="flex items-center justify-center px-2">
                                            <input name="party[]" type="text" id="party"
                                                class="w-full h-12 px-3 text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                                                placeholder="Enter candidate's' party" value="{{ $candidate->party }}"
                                                required>
                                        </div>
                                    </td>
                                    <td class="py-2 text-center">
                                        <div class="flex items-center justify-center w-full h-12">
                                            <button type="button"
                                                class="p-0.5 text-white rounded-sm bg-rose-600 shadow-lg hover:bg-rose-700 focus:bg-rose-700 focus:ring focus:ring-rose-300 remove-row">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="flex items-center justify-end w-full">
                <button type="submit"
                    class="w-full px-8 py-2 text-sm font-normal text-white bg-indigo-600 rounded-md shadow-lg sm:w-fit hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
