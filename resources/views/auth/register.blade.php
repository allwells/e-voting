@extends('layout.app')

@section('no-nav', 'no-nav')
@section('nav-border', 'nav-border')
@section('title', 'Register')

@section('content')
    <div id="page-content" class="flex items-center justify-center py-12 mt-10 login-container px-6 lg:px-8">
        <div class="flex flex-col w-full max-w-2xl gap-2">
            <div>
                <h2 class="mb-3 text-lg font-bold text-center uppercase sm:text-xl text-neutral-800">Sign up</h2>
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
                        <fieldset class="w-full md:w-1/2">
                            <label for="fname" class="text-sm font-semibold text-neutral-800">
                                First Name
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="fname" name="fname" type="text"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                placeholder="Enter your first name" value="{{ old('fname') }}" required>

                            <span id='fname-error' class="text-red-600 text-md error-text"></span>
                        </fieldset>

                        {{-- last name input field --}}
                        <fieldset class="w-full md:w-1/2">
                            <label for="lname" class="text-sm font-semibold text-neutral-800">
                                Last Name
                            </label>
                            <input id="lname" name="lname" type="text"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                placeholder="Enter your last name" value="{{ old('lname') }}">

                            <span id='lname-error' class="text-red-600 text-md error-text"></span>
                        </fieldset>
                    </div>

                    <div class="w-full flex flex-col md:flex-row gap-5">
                        {{-- date of birth input field --}}
                        <fieldset class="w-full md:w-1/2">
                            <label for="dob" class="text-sm font-semibold text-neutral-700">
                                Date of Birth
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="dob" name="dob" type="date"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                value="{{ old('dob') }}" required>

                            <span id='dob-error' class="text-red-600 text-md error-text"></span>
                        </fieldset>

                        {{-- Email input field --}}
                        <fieldset class="w-full md:w-1/2">
                            <label for="email" class="text-sm font-semibold text-neutral-700">
                                Email
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="email" name="email" type="email"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                placeholder="Enter email address" value="{{ old('email') }}" required>

                            <span id='email-error' class="text-red-600 text-md error-text"></span>
                        </fieldset>
                    </div>

                    <div class="w-full flex flex-col md:flex-row gap-5">
                        {{-- password input field --}}
                        <fieldset class="w-full md:w-1/2">
                            <label for="password" class="text-sm font-semibold text-neutral-700">
                                Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password" name="password" type="password"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                placeholder="Choose a password" required>

                            <span id='password-error' class="text-red-600 text-md error-text"></span>
                        </fieldset>

                        {{-- password confirmation input field --}}
                        <fieldset class="w-full md:w-1/2">
                            <label for="password-confirmation" class="text-sm font-semibold text-neutral-700">
                                Confirm Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password-confirmation" name="password_confirmation" type="password"
                                class="relative block w-full h-11 px-3 mt-1 text-sm font-medium duration-300 border rounded-lg text-neutral-800 border-neutral-300 outline-0 hover:ring-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                                placeholder="Confirm your password" required>
                        </fieldset>
                    </div>
                </div>

                <fieldset class="flex flex-col w-full gap-2 mt-3">
                    <button type="submit"
                        class="bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 rounded-lg font-semibold py-3 text-white text-base w-full">
                        Sign Up
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex ml-0.5 text-sm font-medium">
                        <span class="mr-1 text-neutral-600">Already have an account?</span>
                        <a class="text-[#0000FF] font-semibold signup-btn hover:underline hover:text-[#0000DD]"
                            href="{{ route('login') }}">
                            Log in
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
