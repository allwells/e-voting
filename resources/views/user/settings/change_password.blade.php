@extends('user.settings')
@section('title', 'Change Password')
@section('password-settings-sub-tab', 'password-settings-sub-tab')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('settings-page')
    <form action="{{ route('settings.password') }}" method="POST"
        class="flex flex-col w-full gap-2 p-4 bg-white rounded-xl sm:p-5">
        @csrf

        <div class="flex flex-col w-full md:flex-row">
            <div class="w-full">
                <label class="text-base font-bold text-neutral-800">Change Password</label>

                <x-success_message />
                <x-warning_message />
                <x-error_message />

                <div
                    class="flex flex-col-reverse gap-4 p-3 py-6 mt-3 border rounded-md md:flex-row-reverse sm:rounded-xl md:px-4">
                    <div class="flex flex-col items-start justify-between w-full gap-4 md:w-3/5">
                        <div class="w-full">
                            <label for="current_password" class="text-sm font-medium text-neutral-900 dark:text-neutral-400">
                                Current Password
                                <span class="text-red-600">*</span>
                            </label>

                            <input type="password" name="current_password" id="current_password"
                                placeholder="Enter your current password"
                                class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-900 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                required />
                        </div>

                        <div class="w-full">
                            <label for="password" class="text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                New Password
                                <span class="text-red-600">*</span>
                            </label>

                            <div class="flex flex-col items-start justify-start gap-1.5">
                                <input type="password" name="password" id="password" placeholder="Choose a new password"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-900 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                    required />
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="password_confirmation"
                                class="text-sm font-medium text-neutral-900 dark:text-neutral-400">
                                Confirm Password
                                <span class="text-red-600">*</span>
                            </label>

                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm your new password"
                                class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-900 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                required />
                        </div>
                    </div>

                    <div class="w-full md:w-2/5">
                        <div class="ml-1">
                            <p class="text-lg text-neutral-900 text-medium">Password must:</p>
                            <ul
                                class="flex flex-col items-start justify-start gap-2 pl-4 mt-1 text-xs tracking-wide list-disc text-neutral-600">
                                <li>Be at least <strong>6 characters</strong> long</li>
                                <li>Contain a mixture of both <strong>uppercase</strong> and
                                    <strong>lowercase</strong>
                                    letters.
                                </li>
                                <li>Contain a mixture of <strong>letters</strong> and <strong>numbers</strong>.</li>
                                <li>Include at least <strong>one</strong> special character, e.g. <strong>, ! @ # ?
                                        ]</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end w-full mt-3">
            <button type="submit"
                class="w-full flex justify-center items-center gap-1 sm:w-fit py-2.5 px-6 text-sm font-bold tracking-wide text-white rounded-lg bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                    </path>
                </svg>
                Save
            </button>
        </div>
    </form>

@endsection
