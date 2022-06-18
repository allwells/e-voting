@extends('layout.layout')
@section('title', 'Settings')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <form action="{{ route('settings') }}" method="POST"
        class="w-full bg-white flex gap-5 rounded-xl p-5 md:flex-row flex-col">
        @csrf

        <div class="w-full md:w-6/12">
            <label class="text-neutral-500 font-medium text-base">Edit Profile</label>

            <div class="mt-3 border rounded-xl flex flex-col gap-3 p-6">
                <div>
                    <label for="fname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                        First Name
                    </label>
                    <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                        value="{{ auth()->user()->fname }}"
                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                        required />
                </div>

                <div>
                    <label for="lname" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                        Last Name
                    </label>
                    <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                        value="{{ auth()->user()->lname }}"
                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600" />
                </div>

                <div>
                    <label for="dob" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                        Date of Birth
                    </label>
                    <input type="date" name="dob" id="dob" value="{{ auth()->user()->dob }}"
                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                        required />
                </div>

                <div>
                    <label for="phone" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                        Phone
                    </label>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                        value="{{ auth()->user()->phone }}"
                        class="mt-1 w-full text-sm px-3 transition duration-300 border rounded-md h-10 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                        required />
                </div>

                <div>
                    <label for="email" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                        Email
                    </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address"
                        value="{{ auth()->user()->email }}"
                        class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                        required />
                </div>
            </div>
        </div>

        <div class="w-full md:w-6/12 flex flex-col gap-4">
            <div>
                <label class="text-neutral-500 font-medium text-base">Change Password</label>

                <div class="mt-3 border rounded-xl flex flex-col gap-3 p-6">
                    <div>
                        <label for="current_password" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Current Password
                        </label>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="Enter your current password"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>

                    <div>
                        <label for="password" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            New Password
                        </label>
                        <input type="password" name="password" id="password" placeholder="Enter a new password"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm your new password"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-neutral-200 rounded h-11 outline-0 bg-transparent dark:bg-neutral-800 text-neutral-600 dark:text-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />

                        @error('password')
                            <div class="mt-2 text-red-600 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="text-neutral-500 font-medium text-base">Notifications</label>

                <div class="mt-3 border rounded-xl flex flex-col gap-3 p-6">
                    <div class="border rounded-md px-4 py-2 flex justify-between items-center">
                        <div class="text-neutral-500">
                            <p class="text-sm font-medium">Email Notification</p>
                            <span class="text-xs">Get email notifications about election results.</span>
                        </div>
                        <div>
                            <input type="checkbox" name="email_notification" id="email_notification"
                                class="h-5 w-5 border border-neutral-400 rounded text-indigo-600 focus:ring-indigo-600 focus:ring-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
