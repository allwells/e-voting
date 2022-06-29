@extends('layout.layout')

@section('title', 'Add User')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')
@section('add-users-sub-tab', 'add-users-sub-tab')

@section('views')
    <div class="w-full bg-white flex flex-col gap-2 rounded-xl p-4 sm:p-5">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">Add User</label>

        <form action="{{ route('users.add') }}" method="POST" class="w-full flex flex-col gap-5 add-users-form">
            @csrf

            <div
                class="users-success-msg items-center justify-between hidden w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-normal border rounded cursor-default border-emerald-600 text-emerald-800 bg-emerald-200 h-fit">
                <span class="users-message">User added successfully!</span>
                <span
                    class="p-1 transition duration-300 rounded-sm cursor-pointer close-users-success-msg text-emerald-700 hover:bg-emerald-400/50">
                    <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </span>
            </div>

            <div class="mt-3 border rounded-xl flex flex-col gap-3 w-full p-3 sm:p-6">
                <div class="w-full flex sm:flex-row flex-col gap-4">
                    <div class="w-full sm:w-6/12">
                        <label for="fname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            First Name
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="lname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Last Name
                        </label>

                        <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600" />
                    </div>
                </div>

                <div class="w-full flex sm:flex-row flex-col gap-4">
                    <div class="w-full sm:w-6/12">
                        <label for="phone" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Phone
                        </label>

                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border rounded-md h-10 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600" />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="email" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Email
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="email" name="email" id="email" placeholder="Enter your email address"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-end items-center">
                <button type="submit"
                    class="w-full sm:w-fit py-2 px-8 text-sm font-normal text-white rounded-md bg-indigo-600 shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                    Add User
                </button>
            </div>
        </form>
    </div>
@endsection
