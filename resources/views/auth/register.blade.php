@extends('layout.app')

@section('no-nav', 'no-nav')
@section('title', 'Register')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-4 py-12 mt-10 login-container sm:px-6 lg:px-8">
        <div class="flex flex-col w-full max-w-md gap-2">
            <div>
                <h2 class="mb-3 text-lg font-extrabold text-center uppercase sm:text-xl text-neutral-800">Sign up</h2>
            </div>

            <form id="register-form" class="flex flex-col gap-3" action="{{ route('register') }}" method="POST">
                @csrf

                <div id="success-msg"
                    class="items-center justify-start hidden w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-emerald-300 text-emerald-800 bg-emerald-200 h-fit">
                </div>

                <input type="hidden" name="remember" value="true">
                <div class="flex flex-col gap-2">
                    {{-- first name input field --}}
                    <div>
                        <label for="fname" class="text-sm font-semibold text-neutral-700">
                            First Name
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="fname" name="fname" type="text"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Enter your first name" value="{{ old('fname') }}">

                        <span id='fname-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- last name input field --}}
                    <div>
                        <label for="lname" class="text-sm font-semibold text-neutral-700">
                            Last Name
                        </label>
                        <input id="lname" name="lname" type="text"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Enter your last name" value="{{ old('lname') }}">

                        <span id='lname-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- date of birth input field --}}
                    <div>
                        <label for="dob" class="text-sm font-semibold text-neutral-700">
                            Date of Birth
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="dob" name="dob" type="date"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            value="{{ old('dob') }}">

                        <span id='dob-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- phone input field --}}
                    <div>
                        <label for="phone" class="text-sm font-semibold text-neutral-700">
                            Phone
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="phone" name="phone" type="tel"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Enter your phone number" value="{{ old('phone') }}">

                        <span id='phone-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- Email input field --}}
                    <div>
                        <label for="email" class="text-sm font-semibold text-neutral-700">
                            Email
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="email" name="email" type="email"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Enter email address" value="{{ old('email') }}">

                        <span id='email-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- password input field --}}
                    <div>
                        <label for="password" class="text-sm font-semibold text-neutral-700">
                            Password
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="password" name="password" type="password"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Choose a password">

                        <span id='password-error' class="text-red-600 text-md error-text"></span>
                    </div>

                    {{-- password confirmation input field --}}
                    <div>
                        <label for="password-confirmation" class="text-sm font-semibold text-neutral-700">
                            Confirm Password
                            <span class="text-rose-500">*</span>
                        </label>
                        <input id="password-confirmation" name="password_confirmation" type="password"
                            class="relative block w-full h-10 px-2 mt-1 text-sm duration-300 border rounded text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Confirm your password">
                    </div>
                </div>

                <div class="flex flex-col w-full gap-2 mt-3">
                    <button type="submit"
                        class="relative flex items-center justify-center w-full h-10 text-base font-bold text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-lg hover:bg-indigo-700 ring-1 ring-transparent focus:ring-indigo-600 focus:border-white hover:border-indigo-600 shadow-neutral-300 signup-submit-btn focus:outline-none">
                        Sign Up
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex ml-0.5 text-sm">
                        <span class="mr-1 text-neutral-700">Already have an account?</span>
                        <a class="text-indigo-600 signup-btn hover:underline" href="{{ route('login') }}">
                            Log in
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
