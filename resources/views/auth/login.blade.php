@extends('layout.app')

@section('no-nav', 'no-nav')
@section('nav-border', 'nav-border')
@section('title', 'Login')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-6 py-12 login-container lg:px-8">
        <div class="flex flex-col w-full max-w-lg gap-2">
            <div>
                <h2 class="text-lg font-bold text-center uppercase sm:text-xl text-neutral-800">Login</h2>
            </div>

            <form id="login-for" class="flex flex-col gap-4" action="{{ route('login') }}" method="POST">
                @csrf

                <x-error_message />

                <input type="hidden" name="remember" value="true">

                <div class="flex flex-col gap-4">
                    <fieldset>
                        <label for="email-address" class="text-sm font-semibold text-neutral-800">Email</label>
                        <input id="email-address" name="email" type="email" required
                            class="relative block w-full px-3 mt-1 font-medium text-sm duration-300 border rounded-md h-11 text-neutral-800 border-neutral-300 focus:ring-0 outline-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                            placeholder="Enter your email address" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <label for="password" class="text-sm font-semibold text-neutral-800">Password</label>
                        <input id="password" name="password" type="password" required
                            class="relative block w-full px-3 mt-1 font-medium text-sm duration-300 border rounded-md h-11 text-neutral-800 border-neutral-300 focus:ring-0 outline-0 hover:border-neutral-500 focus:outline-none focus:border-[#0000FF] focus:z-10"
                            placeholder="Enter your password">

                        @error('password')
                            <div class="text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </fieldset>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="w-4 h-4 text-[#0000FF] rounded border-neutral-300 border-1 focus:ring-[#0000FF] hover:cursor-pointer">
                        <label for="remember-me"
                            class="block ml-2 text-sm font-medium text-neutral-700 hover:text-neutral-800 hover:cursor-pointer">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-2">
                    <button type="submit"
                        class="w-full py-3 text-base text-white font-semibold bg-[#0000FF] rounded-md hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30">
                        Login
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex items-center justify-between">
                        <div class="flex text-sm font-medium w-fit">
                            <span class="mr-1 text-neutral-700">Don't have an account?</span>
                            <a class="text-[#0000FF] signup-btn font-semibold hover:underline hover:text-[#0000DD]"
                                href="{{ route('register') }}">
                                Register
                            </a>
                        </div>

                        <span class="w-fit">
                            <a href="{{ route('password.reset.link') }}"
                                class="text-sm font-semibold text-[#0000FF] hover:underline">Forgot password?</a>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
