@extends('layout.layout')

@section('views')
    <div class="flex flex-col justify-start w-full mb-20 align-middle user-settings">
        <span
            class="mt-4 text-2xl font-bold text-left capitalize cursor-default lg:text-3xl text-neutral-800 dark:text-neutral-200">
            Settings
        </span>

        <div class="flex flex-col items-start justify-start mt-4 mb-28">
            {{-- Appearance --}}
            <div class="w-full">
                <label for="appearance"
                    class="block font-semibold text-md md:text-lg text-neutral-700 dark:text-neutral-200">
                    Appearance
                </label>

                {{-- Theme --}}
                <div class="pt-2">
                    <label for="theme" class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                        Theme
                    </label>

                    <form action="{{ route('settings.theme') }}" method="post">
                        @csrf

                        {{-- Mode selection --}}
                        <select id="theme" name="theme"
                            class="bg-neutral-50 border dark:hover:border-neutral-400 transition duration-300 hover:border-neutral-500 sm:w-1/5 w-full border-neutral-300 mt-1 text-neutral-700 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

                            {{-- light mode option --}}
                            <option class="py-4" @if ($user->mode == 'light') selected @endif value="light">
                                Light
                            </option>

                            {{-- dark mode option --}}
                            <option class="py-4" @if ($user->mode == 'dark') selected @endif value="dark">
                                Dark
                            </option>
                        </select>

                        <div class="w-full mt-4">
                            <button type="submit"
                                class="text-white px-12 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Change email --}}
            <div class="w-full mt-8 md:w-1/2">
                <label for="change-email"
                    class="block font-semibold text-md md:text-lg text-neutral-700 dark:text-neutral-200">
                    Change Email
                </label>

                <form class="px-1 space-y-2" action="{{ route('settings') }}" method="post">
                    @csrf

                    <div class="-space-y-px rounded-md shadow-sm">
                        <div class="mb-6">
                            <label for="email-address" class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                                Email address
                            </label>
                            <input id="email-address" name="email" type="email" autocomplete="email"
                                value="{{ $user->email }}" required
                                class="relative block w-full px-3 py-2 mt-1 text-sm transition duration-300 border rounded-md text-neutral-700 dark:hover:border-neutral-400 hover:border-neutral-500 border-neutral-200 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-md dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <button type="submit"
                            class="text-white px-12 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                            <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
            </div>


            {{-- Change password --}}
            <div class="w-full mt-8 md:w-1/2">
                <label for="change-password"
                    class="block font-semibold text-md md:text-lg text-neutral-700 dark:text-neutral-200">
                    Change Password
                </label>

                <form class="px-1 space-y-4" action="{{ route('settings') }}" method="post">
                    @csrf

                    {{-- current password input field --}}
                    <div class="-space-y-px rounded-md shadow-sm">
                        <div class="mb-4">
                            <label for="current_password"
                                class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                                Current Password
                            </label>

                            <input id="current_password" name="current_password" type="current_password"
                                placeholder="Enter your current password" required
                                class="relative block w-full px-3 py-2 mt-1 text-sm transition duration-300 border rounded-md text-neutral-700 dark:hover:border-neutral-400 hover:border-neutral-500 border-neutral-200 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-md dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- new password input field --}}
                    <div class="-space-y-px rounded-md shadow-sm">
                        <div class="mb-4">
                            <label for="password" class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                                New Password
                            </label>

                            <input id="password" name="password" type="password" placeholder="Enter a new password" required
                                class="relative block w-full px-3 py-2 mt-1 text-sm transition duration-300 border rounded-md text-neutral-700 dark:hover:border-neutral-400 hover:border-neutral-500 border-neutral-200 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-md dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        </div>
                    </div>

                    {{-- password confirmation input field --}}
                    <div class="pb-2">
                        <label for="password-confirmation"
                            class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                            Confirm New Password
                        </label>

                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Confirm your new password" required
                            class="relative block w-full px-3 py-2 mt-1 text-sm transition duration-300 border rounded-md text-neutral-700 dark:hover:border-neutral-400 hover:border-neutral-500 border-neutral-200 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-md dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

                        @error('password')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="w-full sm:w-fit">
                        <button type="submit"
                            class="text-white px-12 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 mr-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                            <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
