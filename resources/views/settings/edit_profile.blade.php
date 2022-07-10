@extends('layout.layout')
@section('title', 'Edit Profile')
@section('profile-settings-sub-tab', 'profile-settings-sub-tab')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <form action="{{ route('settings.profile') }}" method="POST"
        class="flex flex-col w-full gap-2 p-3 bg-white rounded-xl sm:p-5">
        @csrf

        <div class="w-full">
            <label class="text-base font-medium text-neutral-600">Edit Profile</label>

            <x-success_message />
            <x-warning_message />
            <x-error_message />

            <div class="flex flex-col gap-3 p-3 mt-3 border rounded-md sm:rounded-xl md:p-4">
                <div class="flex flex-col items-start justify-between w-full gap-4 md:flex-row">
                    <div class="w-full md:w-1/2">
                        <label for="fname" class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            First Name
                            <span class="text-red-600">*</span>
                        </label>

                        <div class="flex flex-col items-start justify-start gap-1.5">
                            <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                                value="{{ auth()->user()->fname }}"
                                class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0"
                                required />

                            <div class="ml-0.5 text-xs text-neutral-500">
                                This field is <strong>required</strong>.
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label for="lname" class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Last Name
                            <span class="text-red-600">*</span>
                        </label>

                        <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                            value="{{ auth()->user()->lname }}"
                            class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0" />
                    </div>
                </div>

                <div class="flex flex-col items-start justify-between w-full gap-4 md:flex-row">
                    <div class="w-full md:w-1/2">
                        <label for="dob" class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Date Of Birth
                            <span class="text-red-600">*</span>
                        </label>

                        <div class="flex flex-col items-start justify-start gap-1.5">
                            <input type="date" name="dob" id="dob" value="{{ auth()->user()->dob }}"
                                class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0"
                                required />

                            <div class="ml-0.5 text-xs text-neutral-500">
                                This field is <strong>required</strong>.
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label for="phone" class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Phone
                            <span class="text-red-600">*</span>
                        </label>

                        <div class="flex flex-col items-start justify-start gap-1.5">
                            <input type="tel" name="phone" id="phone" value="{{ auth()->user()->phone }}"
                                class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0" />

                            <div class="ml-0.5 text-xs text-neutral-500">
                                Phone number must be at least <strong>10 digits</strong> short and <strong>16
                                    digits</strong> long.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end w-full p-3 mt-3 border rounded-md sm:rounded-xl md:p-4">
            <button type="submit"
                class="w-full sm:w-fit py-3 px-10 text-sm font-medium text-white rounded bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40">
                Save
            </button>
        </div>
    </form>
@endsection
