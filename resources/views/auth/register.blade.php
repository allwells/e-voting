@extends('layout.app')

@section('title', 'Register')

@section('content')
    <div class="flex items-center justify-center px-4 py-12 mt-10 h-fit signup-container sm:px-6 lg:px-8">
        <div class="w-full max-w-3xl space-y-8">

            <div>
                <h2 class="pt-6 text-2xl font-extrabold text-center text-gray-800">Sign up to vote</h2>
            </div>
            <form id="register-form" class="mt-8 space-y-8" action="{{ route('register') }}" method="POST">
                @csrf

                <div id="success-msg"
                    class="border-white hidden items-center justify-start text-left px-3 text-md border-2 py-3 ring-1 ring-emerald-300 cursor-default text-emerald-800 font-normal bg-emerald-200 h-fit w-full">
                </div>

                <input type="hidden" name="remember" value="true">
                <div class="flex flex-col gap-4">

                    <div class="flex gap-4 md:flex-row flex-col">
                        {{-- first name input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="fname" class="font-semibold text-gray-700">First Name
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="fname" name="fname" type="text"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Enter your first name" value="{{ old('fname') }}">

                            <span id='fname-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- last name input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="lname" class="font-semibold text-gray-700">Last Name</label>
                            <input id="lname" name="lname" type="text"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Enter your last name" value="{{ old('lname') }}">

                            <span id='lname-error' class="text-red-600 text-md error-text"></span>
                        </div>
                    </div>

                    <div class="flex gap-4 md:flex-row flex-col">
                        {{-- Email input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="email" class="font-semibold text-gray-700">Email
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="email" name="email" type="email"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Enter email address" value="{{ old('email') }}">

                            <span id='email-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- phone input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="phone" class="font-semibold text-gray-700">Phone Number
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="phone" name="phone" type="tel"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">

                            <span id='phone-error' class="text-red-600 text-md error-text"></span>
                        </div>
                    </div>

                    <div class="flex gap-4 md:flex-row flex-col">
                        {{-- date of birth input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="dob" class="font-semibold text-gray-700">Date of Birth
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="dob" name="dob" type="date"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Date of Birth(dd-mm-yyyy)" value="{{ old('dob') }}">

                            <span id='dob-error' class="text-red-600 text-md error-text"></span>
                        </div>

                        {{-- password input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="password" class="font-semibold text-gray-700">Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password" name="password" type="password"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Choose a password">

                            <span id='password-error' class="text-red-600 text-md error-text"></span>
                        </div>
                    </div>

                    <div class="flex gap-4 md:flex-row flex-col">
                        {{-- password confirmation input field --}}
                        <div class="md:w-6/12 w-full">
                            <label for="password-confirmation" class="font-semibold text-gray-700">Confirm Password
                                <span class="text-rose-500">*</span>
                            </label>
                            <input id="password-confirmation" name="password_confirmation" type="password"
                                class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 h-14 border-gray-200 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 text-base"
                                placeholder="Confirm your password">
                        </div>
                    </div>
                </div>

                {{-- signup button --}}
                <div class="flex gap-4 flex-col">
                    <div class="md:w-6/12 w-full">
                        <button type="submit"
                            class="signup-submit-btn py-2 h-14 w-full px-8 font-semibold border-4 border-white text-white ring-1 ring-indigo-600 bg-indigo-600 shadow-lg hover:shadow-indigo-300 active:shadow-none transition duration-300">
                            Sign up
                        </button>
                    </div>

                    {{-- Link to login page --}}
                    <div class="flex text-sm md:w-6/12 w-full">
                        <span class="mr-1 text-gray-700">Already have an account?</span>
                        <a class="login-btn text-indigo-600 hover:underline font-bold" href="{{ route('login') }}">Log
                            in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
