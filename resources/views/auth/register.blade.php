@extends('layout.app')

@section('content')
    <div class="flex items-center justify-center px-4 py-12 mt-10 h-fit signup-container sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">

            <div>
                <h2 class="pt-6 text-2xl font-extrabold text-center text-gray-800">Sign up to vote</h2>
            </div>
            <form id="signup-form" class="mt-8 space-y-8" action="{{ route('register') }}" method="POST">
                @csrf

                <div id="success-msg"
                    class="border-emerald-700 hidden items-center justify-between text-left px-3 text-md border-2 py-3 rounded-md text-neutral-800 font-semibold bg-emerald-300/90 h-fit w-full">
                    <span id="success-message"></span>
                    <span id="close-success-msg"
                        class="p-1 rounded-full hover:bg-emerald-600 text-neutral-800 hover:text-white cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </span>
                </div>

                <input type="hidden" name="remember" value="true">
                <div class="-space-y-px">

                    {{-- name input field --}}
                    <div class="mb-6">
                        <label for="name" class="font-semibold text-gray-700">Name</label>
                        <input id="name" name="name" type="text"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter full name" value="{{ old('name') }}">

                        <span id='name-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- username input field --}}
                    <div class="mb-6">
                        <label for="username" class="font-semibold text-gray-700">Username</label>
                        <input id="username" name="username" type="text"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Choose a username" value="{{ old('username') }}">

                        <span id='username-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- Email input field --}}
                    <div class="pt-6">
                        <label for="email-address" class="font-semibold text-gray-700">Email</label>
                        <input id="email-address" name="email" type="email"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter email address" value="{{ old('email') }}">

                        <span id='email-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- password input field --}}
                    <div class="pt-6">
                        <label for="password" class="font-semibold text-gray-700">Password</label>
                        <input id="password" name="password" type="password"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Choose a password">

                        <span id='password-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- password confirmation input field --}}
                    <div class="pt-6">
                        <label for="password-confirmation" class="font-semibold text-gray-700">Confirm Password</label>
                        <input id="password-confirmation" name="password_confirmation" type="password"
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border border-gray-200 rounded hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Confirm your password">
                    </div>
                </div>

                {{-- signup button --}}
                <div>
                    <button type="submit"
                        class="signup-submit-btn relative flex justify-center w-full px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-md group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
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
                        <a class="login-btn text-indigo-600 hover:underline" href="{{ route('login') }}">Log in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
