@extends('layout.layout')

@section('title', 'settings')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <div class="w-full px-1">
        {{-- <x-live_heading text="Settings" /> --}}

        <div class="pb-6 text-neutral-500 dark:text-neutral-200">
            {{-- Appearance settings --}}
            <div class="flex flex-col gap-1">
                <h2 class="text-base font-bold uppercase md:text-lg text-neutral-800 dark:text-neutral-100">
                    Appearance
                </h2>

                <span
                    class="text-sm text-blue-700 font-medium bg-blue-100 border border-blue-700 flex gap-2 items-center justify-start w-full sm:w-fit p-2 rounded-md">
                    <i class="fas fa-info border-2 border-blue-700 py-1 px-2 rounded-full text-xs"></i>
                    Sorry, this feature has been disabled for now.
                </span>

                <div class="flex flex-col items-start justify-start gap-1 mt-2">
                    <label for="theme" class="text-sm font-normal text-neutral-600 dark:text-neutral-400">Theme</label>
                    <form class="flex items-center justify-start w-11/12 gap-4 xl:w-1/4 lg:w-2/5 sm:w-1/2"
                        action="{{ route('settings.theme') }}" method="POST">
                        @csrf

                        <select name="theme" id="theme" disabled
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

                        <button disabled type="submit"
                            class="font-semibold transition duration-300 w-fit h-fit text-neutral-700 dark:text-neutral-400 hover:text-indigo-600 dark:hover:text-indigo-500">
                            Set
                        </button>
                    </form>
                </div>
            </div>

            {{-- account settings --}}
            <div class="mt-6">
                <h2 class="text-base font-bold uppercase md:text-lg text-neutral-800 dark:text-neutral-100">
                    Account
                </h2>

                {{-- change email setting --}}
                <div class="w-full gap-2 mt-2 md:w-1/2">
                    <label for="email" class="text-sm font-normal text-neutral-600 dark:text-neutral-400">
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
                            <button type="submit"
                                class="w-full px-6 font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-lg focus:border-white focus:shadow-none h-9 text-sm hover:bg-indigo-500 sm:w-fit shadow-indigo-400 ring-1 ring-transparent focus:ring-indigo-600 dark:focus:border-neutral-900 dark:shadow-black">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Change password setting --}}
            <div class="w-full mt-6 md:w-1/2">
                <label for="change-password" class="text-sm font-normal text-neutral-700 dark:text-neutral-200">
                    Change Password
                </label>

                <form class="flex flex-col gap-3" action="{{ route('settings.password') }}" method="post">
                    @csrf

                    {{-- current password input field --}}
                    <div>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="Enter your current password"
                            class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>

                    {{-- new password input field --}}
                    <div>
                        <input type="password" name="password" id="password" placeholder="Enter a new password"
                            class="w-full mt-1 text-sm transition duration-300 border rounded-md h-11 outline-0 bg-neutral-50 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 border-neutral-200 hover:border-neutral-400 dark:hover:border-neutral-500 dark:border-neutral-700 focus:border-indigo-600 dark:focus:border-indigo-600"
                            required />
                    </div>

                    {{-- password confirmation input field --}}
                    <div>
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
                        <button type="submit"
                            class="w-full px-6 font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-lg focus:border-white focus:shadow-none h-9 text-sm hover:bg-indigo-500 sm:w-fit shadow-indigo-400 ring-1 ring-transparent focus:ring-indigo-600 dark:focus:border-neutral-900 dark:shadow-black">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
