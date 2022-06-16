@extends('layout.layout')

@section('title', 'settings')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-28">
        <div
            class="w-full min-h-full p-4 tracking-wide bg-white border rounded-lg shadow-lg shadow-neutral-300 dark:shadow-black border-neutral-100 dark:border-neutral-800 md:px-8 dark:bg-neutral-900 dark:ring-neutral-900 ring-1 ring-white">
            <x-live_heading text="Settings" />

            <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                {{-- Appearance settings --}}
                <div>
                    <h2 class="text-base font-bold uppercase md:text-lg text-neutral-800 dark:text-neutral-100">
                        Appearance
                    </h2>
                    <div class="flex flex-col items-start justify-start gap-1 mt-2">
                        <label for="theme" class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Theme</label>
                        <form class="flex items-center justify-start w-11/12 gap-4 xl:w-1/4 lg:w-2/5 sm:w-1/2"
                            action="{{ route('settings.theme') }}" method="POST">
                            @csrf

                            <select name="theme" id="theme"
                                class="w-full text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600">
                                {{-- light theme option --}}
                                <option
                                    class="text-sm border outline-0 text-neutral-700 bg-neutral-50 border-neutral-100 dark:text-neutral-200 dark:bg-neutral-800 dark:border-neutral-700 dark:ring-0"
                                    @if (auth()->user()->theme == 'light') selected @endif value="light">
                                    Light
                                </option>

                                {{-- dark theme option --}}
                                <option
                                    class="text-sm border outline-0 text-neutral-700 bg-neutral-50 border-neutral-100 dark:text-neutral-200 dark:bg-neutral-800 dark:border-neutral-700 dark:ring-0"
                                    @if (auth()->user()->theme == 'dark') selected @endif value="dark">
                                    Dark
                                </option>
                            </select>

                            <button
                                class="font-semibold transition duration-300 w-fit h-fit text-neutral-700 dark:text-neutral-400 hover:text-indigo-600 dark:hover:text-indigo-500">
                                Set
                            </button>
                        </form>
                    </div>
                </div>

                {{-- account settings --}}
                <div class="mt-14">
                    <h2 class="text-base font-bold uppercase md:text-lg text-neutral-800 dark:text-neutral-100">
                        Account
                    </h2>

                    {{-- change email setting --}}
                    <div class="w-full gap-2 mt-2 md:w-1/2">
                        <label for="email" class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                            Change email
                        </label>
                        <form action="{{ route('settings.email') }}" method="post"
                            class="flex flex-col items-start justify-start gap-4">
                            @csrf

                            <input type="email" name="email" id="email" placeholder="Enter new email address"
                                value="{{ auth()->user()->email }}"
                                class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                                required />

                            <div class="w-full sm:w-fit">
                                <button
                                    class="w-full px-10 font-medium text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-lg focus:border-white h-11 hover:bg-indigo-500 sm:w-fit shadow-indigo-400 ring-1 ring-transparent focus:ring-indigo-600 dark:focus:border-neutral-900 dark:shadow-black">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Change password setting --}}
                <div class="w-full mt-8 md:w-1/2">
                    <label for="change-password"
                        class="text-base font-semibold md:text-lg text-neutral-700 dark:text-neutral-200">
                        Change Password
                    </label>

                    <form class="flex flex-col gap-3 mt-2" action="{{ route('settings.password') }}" method="post">
                        @csrf

                        {{-- current password input field --}}
                        <div>
                            <label for="current_password" class="text-sm text-neutral-500 dark:text-neutral-400">
                                Current Password
                            </label>

                            <input type="password" name="current_password" id="current_password"
                                placeholder="Enter current password"
                                class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                                required />
                        </div>

                        {{-- new password input field --}}
                        <div>
                            <label for="password" class="text-sm text-neutral-500 dark:text-neutral-400">
                                New Password
                            </label>

                            <input type="password" name="password" id="password" placeholder="Enter a new password"
                                class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                                required />
                        </div>

                        {{-- password confirmation input field --}}
                        <div>
                            <label for="password_confirmation" class="text-sm text-neutral-500 dark:text-neutral-400">
                                Confirm New Password
                            </label>

                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm new password"
                                class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                                required />

                            @error('password')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="w-full sm:w-fit">
                            <button
                                class="w-full px-10 font-medium text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-lg focus:border-white h-11 hover:bg-indigo-500 sm:w-fit shadow-indigo-400 ring-1 ring-transparent focus:ring-indigo-600 dark:focus:border-neutral-900 dark:shadow-black">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
