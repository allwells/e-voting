@extends('layout.app')

@section('content')
    <div class="flex items-center justify-center px-4 py-12 mt-10 h-fit signup-container sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="pt-6 text-2xl font-extrabold text-center text-gray-800">Sign up to vote</h2>
            </div>
            <form class="mt-8 space-y-8" action="{{ route('register') }}" method="POST">
                @csrf

                <input type="hidden" name="remember" value="true">
                <div class="-space-y-px">

                    {{-- first name input field --}}
                    <div class="mb-6">
                        <label for="name" class="font-semibold text-gray-700">Name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter full name" value="{{ old('name') }}">

                        @error('name')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- last name input field --}}
                    <div class="mb-6">
                        <label for="username" class="font-semibold text-gray-700">Username</label>
                        <input id="username" name="username" type="text" autocomplete="name"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Choose a username" value="{{ old('username') }}">

                        @error('username')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email input field --}}
                    <div class="pt-6">
                        <label for="email-address" class="font-semibold text-gray-700">Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter email address" value="{{ old('email') }}">

                        @error('email')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- password input field --}}
                    <div class="pt-6">
                        <label for="password" class="font-semibold text-gray-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Choose a password">

                        @error('password_confirmation')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- confirm password input field --}}
                    <div class="pt-6">
                        <label for="password-confirmation" class="font-semibold text-gray-700">Confirm Password</label>
                        <input id="password-confirmation" name="password_confirmation" type="password"
                            autocomplete="current-password" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Confirm your password">

                        @error('password')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- signup button --}}
                <div>
                    <button type="submit"
                        class="relative flex justify-center w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-md group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <!-- Heroicon name: solid/lock-closed -->
                            <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign up
                    </button>

                    {{-- Link to login page --}}
                    <div class="flex mt-3 text-sm">
                        <span class="mr-1 text-gray-700">Already have an account?</span>
                        <a class="text-indigo-600 hover:underline" href="{{ route('login') }}">Log in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
