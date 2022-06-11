@extends('layout.app')

@section('no-nav', 'no-nav')
@section('title', 'Login')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-4 py-12 login-container sm:px-6 lg:px-8">
        <div class="flex flex-col w-full max-w-md gap-2">
            <div>
                <h2 class="text-lg font-extrabold text-center uppercase sm:text-xl text-neutral-800">Login</h2>
            </div>
            <form id="login-form" class="flex flex-col gap-3" action="{{ route('login') }}" method="POST">
                @csrf

                @if (session('status'))
                    <div
                        class="items-center justify-start w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-rose-300 text-rose-800 bg-rose-200 h-fit">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="remember" value="true">
                <div class="flex flex-col gap-2">
                    <div>
                        <label for="email-address" class="text-sm font-semibold text-neutral-700">Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full px-2 mt-1 text-sm duration-300 border rounded h-11 text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                            placeholder="Enter your email address" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="text-sm font-semibold text-neutral-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full px-2 mt-1 text-sm duration-300 border rounded h-11 text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
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
                            class="w-4 h-4 text-indigo-600 rounded border-neutral-300 border-1 focus:ring-indigo-600">
                        <label for="remember-me" class="block ml-2 text-sm text-neutral-700">Remember me</label>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-2">
                    <button type="submit"
                        class="relative flex items-center justify-center w-full h-10 text-base font-bold text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-lg hover:bg-indigo-700 ring-1 ring-transparent focus:ring-indigo-600 focus:border-white hover:border-indigo-600 shadow-neutral-300 login-submit-btn focus:outline-none">
                        Login
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex text-sm">
                        <span class="mr-1 text-neutral-700">Don't have an account?</span>
                        <a class="text-indigo-600 signup-btn hover:underline" href="{{ route('register') }}">
                            Register
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
