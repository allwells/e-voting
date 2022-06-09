@extends('layout.app')

@section('title', 'Login')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-4 py-12 login-container sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-2xl font-extrabold text-center text-gray-800">Login</h2>
            </div>
            <form id="login-form" class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                @if (session('status'))
                    <div
                        class="items-center justify-start w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-rose-300 text-rose-800 bg-rose-200 h-fit">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="remember" value="true">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div class="mb-6">
                        <label for="email-address" class="font-semibold text-gray-700">Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter your email address" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="font-semibold text-gray-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full px-3 py-2 mt-1 text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10 sm:text-sm"
                            placeholder="Enter your password">

                        @error('password')
                            <div class="text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center hover:cursor-pointer">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="w-4 h-4 text-indigo-600 border-gray-300 border-1 focus:ring-indigo-600">
                        <label for="remember-me" class="block ml-2 text-sm text-gray-700">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="relative flex items-center justify-center w-full text-base font-bold text-indigo-600 transition duration-300 bg-white border-4 border-indigo-600 shadow-lg login-submit-btn h-14 hover:shadow-indigo-300 focus:outline-none active:shadow-none">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <!-- Heroicon name: solid/lock-closed -->
                            <svg class="w-6 h-6 text-indigo-600 group-hover:text-indigo-600"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Login
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex mt-6 text-sm">
                        <span class="mr-1 text-gray-700">Don't have an account?</span>
                        <a class="text-indigo-600 signup-btn hover:underline" href="{{ route('register') }}">
                            Register
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
