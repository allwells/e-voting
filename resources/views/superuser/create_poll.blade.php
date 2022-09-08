@extends('layout.layout')

@section('title', 'Create Poll')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')
@section('create-polls-sub-tab', 'create-polls-sub-tab')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:px-5 sm:py-6 min-h-fit">
        <div>
            <label class="text-sm font-bold text-neutral-600 sm:text-base">Create Poll</label>
            <x-breadcrumbs previousPage="Polls" currentPage="Create Poll" link="polls.view" />
        </div>

        <form action="{{ route('polls.create') }}" method="POST" class="flex flex-col gap-5 create-election-for">
            @csrf

            <div class="flex flex-col p-0 sm:px-5 sm:py-6 sm:border rounded-xl sm:gap-5">
                <x-success_message />
                <x-error_message />
                <x-warning_message />

                <div class="w-full flex flex-col lg:flex-row items-center justify-center">
                    <div class="lg:hidden w-full flex justify-start items-center mb-1">
                        <p class="text-left text-sm font-bold text-neutral-600">Start Date</p>
                    </div>

                    <div class="flex-grow w-full relative flex justify-start items-center gap-5">
                        <div date-rangepicker class="relative flex-grow">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="start_date"
                                class="border border-neutral-200 text-neutral-700 sm:text-sm rounded-lg w-full pl-10 p-2.5"
                                placeholder="Select start date" autocomplete="off" required>
                        </div>

                        <div class="relative flex-grow">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="start_time" type="time"
                                class="border border-neutral-100 text-neutral-800 sm:text-sm rounded-lg outline-0 focus:ring-[#0000FF] w-full pl-10 p-2.5"
                                placeholder="Select start time" autocomplete="off" required>
                        </div>
                    </div>

                    <span class="mx-4 text-neutral-500 font-bold lg:block hidden">to</span>


                    <div class="lg:hidden w-full flex justify-start items-center mb-1 mt-5">
                        <p class="text-left text-sm font-bold text-neutral-600">End Date</p>
                    </div>

                    <div class="flex-grow w-full relative flex justify-start items-center gap-5">
                        <div date-rangepicker class="relative flex-grow">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-neutral-500" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="end_date"
                                class="border border-neutral-200 text-neutral-700 sm:text-sm rounded-lg focus:ring-[#0000FF] w-full pl-10 p-2.5"
                                placeholder="Select end date" autocomplete="off" required>
                        </div>

                        <div class="relative flex-grow">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="end_time" type="time"
                                class="border border-neutral-100 text-neutral-800 sm:text-sm rounded-lg outline-0 focus:ring-[#0000FF] w-full pl-10 p-2.5"
                                placeholder="Select start time" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="border-t"></div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <input name="title" type="text" id="title"
                        class="w-full mt-1 text-xl md:text-3xl font-bold border-0 px-1 focus:ring-0 h-20 outline-0 text-neutral-700 placeholder-neutral-400"
                        placeholder="Enter poll question here..." required>
                </div>

                <div class="flex flex-col gap-2 sm:gap-5">
                    <div class="w-full overflow-x-auto overflow-y-auto">
                        <table class="w-full options-table">
                            <thead class="border-y">
                                <tr>
                                    <th class="text-base text-left font-bold text-neutral-700 pl-1">Poll Options</th>
                                    <th class="w-[10rem] py-3">
                                        <div class="flex relative justify-end items-center">
                                            <button type="button"
                                                class="w-fit p-2 text-neutral-500 hover:text-neutral-800 hover:bg-black/10 text-xs font-bold flex justify-center items-center rounded-md add-option-btn active:scale-95">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" stroke-width="0.1"
                                                    stroke="currentColor" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M13 10H3c-.55 0-1 .45-1 1s.45 1 1 1h10c.55 0 1-.45 1-1s-.45-1-1-1zm0-4H3c-.55 0-1 .45-1 1s.45 1 1 1h10c.55 0 1-.45 1-1s-.45-1-1-1zm5 8v-3c0-.55-.45-1-1-1s-1 .45-1 1v3h-3c-.55 0-1 .45-1 1s.45 1 1 1h3v3c0 .55.45 1 1 1s1-.45 1-1v-3h3c.55 0 1-.45 1-1s-.45-1-1-1h-3zM3 16h6c.55 0 1-.45 1-1s-.45-1-1-1H3c-.55 0-1 .45-1 1s.45 1 1 1z" />
                                                </svg>
                                                Create option
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="options-table">
                                <tr>
                                    <td>
                                        <div class="flex justify-start items-center px-2">
                                            <span class="text-xl font-bold mt-1.5">-</span>
                                            <input name="options[]" type="text" id="option"
                                                class="w-full mt-1 text-base sm:text-lg border-0 h-14 focus:ring-0 outline-0 text-neutral-700 placeholder-neutral-400"
                                                placeholder="Option" autocomplete="off" required>
                                        </div>
                                    </td>

                                    <td class="w-[10rem]">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="flex justify-start items-center px-2">
                                            <span class="text-xl font-bold mt-1.5">-</span>
                                            <input name="options[]" type="text" id="option"
                                                class="w-full mt-1 text-base sm:text-lg border-0 h-14 focus:ring-0 outline-0 text-neutral-700 placeholder-neutral-400"
                                                placeholder="Option" autocomplete="off" required>
                                        </div>
                                    </td>

                                    <td class="w-[10rem]">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-end w-full mt-5">
                    <button type="submit"
                        class="px-3 py-2 text-sm font-bold text-white bg-[#0000FF] rounded-md w-fit hover:bg-[#0000DD] focus:bg-[#0000DD] flex justify-center items-center gap-1 active:scale-95">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Poll
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
