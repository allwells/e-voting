@extends('layout.app')

@section('no-nav', 'no-nav')
@section('nav-border', 'nav-border')
@section('title', 'Register')

@section('content')
    <div id="page-content" class="flex items-center justify-center py-12 mt-10 login-container px-6 lg:px-8">
        <div class="flex flex-col w-full max-w-xl gap-2">
            <div>
                <h2 class="mb-3 text-lg font-extrabold text-center uppercase sm:text-xl text-neutral-800">Sign up</h2>
            </div>

            <form class="register-for flex flex-col gap-3" action="{{ route('register') }}" method="POST">
                @csrf

                <div
                    class="success-msg items-center justify-between hidden w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs sm:text-sm font-normal border rounded cursor-default border-emerald-600 text-emerald-800 bg-emerald-200 h-fit">
                </div>

                <input type="hidden" name="remember" value="true">

                <div class="flex flex-col gap-3">
                    <div class="w-full flex flex-col md:flex-row gap-5">
                        {{-- first name input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="fname" class="text-sm font-semibold text-neutral-700">
                                First Name
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="fname" name="fname" type="text"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                placeholder="Enter your first name" value="{{ old('fname') }}" required>

                            <span id='fname-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- last name input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="lname" class="text-sm font-semibold text-neutral-700">
                                Last Name
                            </label>
                            <input id="lname" name="lname" type="text"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                placeholder="Enter your last name" value="{{ old('lname') }}">

                            <span id='lname-error' class="text-red-600 text-md error-text"></span>
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-row gap-5">
                        {{-- date of birth input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="dob" class="text-sm font-semibold text-neutral-700">
                                Date of Birth
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="dob" name="dob" type="date"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                value="{{ old('dob') }}" required>

                            <span id='dob-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- Email input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="email" class="text-sm font-semibold text-neutral-700">
                                Email
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="email" name="email" type="email"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                placeholder="Enter email address" value="{{ old('email') }}" required>

                            <span id='email-error' class="text-red-600 text-md error-text"></span>
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-row gap-5">
                        {{-- password input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="password" class="text-sm font-semibold text-neutral-700">
                                Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password" name="password" type="password"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                placeholder="Choose a password" required>

                            <span id='password-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- password confirmation input field --}}
                        <div class="w-full md:w-1/2">
                            <label for="password-confirmation" class="text-sm font-semibold text-neutral-700">
                                Confirm Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password-confirmation" name="password_confirmation" type="password"
                                class="relative block w-full h-11 px-3 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                                placeholder="Confirm your password" required>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-2 mt-3">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40 rounded py-3 text-white text-sm w-full">
                        Sign Up
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex ml-0.5 text-sm">
                        <span class="mr-1 text-neutral-600">Already have an account?</span>
                        <a class="text-indigo-600 signup-btn hover:underline hover:text-indigo-700"
                            href="{{ route('login') }}">
                            Log in
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
