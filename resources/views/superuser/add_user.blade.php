@extends('layout.layout')

@section('title', 'Add User')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')
@section('add-users-sub-tab', 'add-users-sub-tab')

@section('views')
    <div class="w-full bg-white flex flex-col gap-2 rounded-xl p-4 sm:p-5">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">Add User</label>

        <x-success_message />
        <x-error_message />
        <x-warning_message />

        <form action="{{ route('users.add') }}" method="POST" class="w-full flex flex-col gap-5 add-users-for">
            @csrf

            <div class="mt-3 border rounded-xl flex flex-col gap-3 w-full p-3 sm:p-6">
                <div class="w-full flex sm:flex-row flex-col gap-5">
                    <div class="w-full sm:w-6/12">
                        <label for="fname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            First Name
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-indigo-600"
                            required />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="lname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Last Name
                        </label>

                        <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-indigo-600" />
                    </div>
                </div>

                <div class="w-full flex sm:flex-row flex-col gap-5">
                    <div class="w-full sm:w-6/12">
                        <label for="phone" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Phone
                        </label>

                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-indigo-600" />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="email" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Email
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="email" name="email" id="email" placeholder="Enter your email address"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-indigo-600"
                            required />
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-end items-center border p-3 rounded-xl">
                <button type="submit"
                    class="w-full sm:w-fit py-3 px-10 text-sm font-normal text-white rounded bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40">
                    Add User
                </button>
            </div>
        </form>
    </div>
@endsection
