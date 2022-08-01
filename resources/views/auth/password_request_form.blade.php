@extends('layout.app')

@section('no-home', 'no-home')
@section('nav-border', 'nav-border')
@section('title', 'Reset Password')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-6 py-12 login-container lg:px-8">
        <div class="flex flex-col w-full max-w-lg gap-2">

            <x-info_message />
            <x-error_message />

            <div>
                <h2 class="text-lg font-extrabold text-center uppercase sm:text-xl text-neutral-800">Forgot Password?</h2>
            </div>

            <form id="login-for" class="flex flex-col gap-2 mt-2" action="{{ route('password.reset.link') }}" method="POST">
                @csrf

                <span class="text-sm text-neutral-600 tracking-wide">
                    Enter your email and we will send you a link to reset your password.
                </span>

                <div class="flex flex-col">
                    {{-- <label for="email" class="text-sm font-semibold text-neutral-700">Email</label> --}}
                    <input id="email" name="email" type="email"
                        class="relative block w-full px-3 mt-1 text-sm duration-300 border rounded h-11 text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                        placeholder="Email address" required>
                </div>

                <div class="flex flex-col w-full gap-2 mt-2">
                    <button type="submit"
                        class="w-full py-3 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40">
                        Request link
                    </button>

                    {{-- Link to sign up page --}}
                    <div class="flex">
                        <a class="flex items-center justify-start text-sm font-medium text-indigo-600 hover:underline"
                            href="{{ route('login') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            Back to home</a>
                    </div>
                </div>


                <div class="text-sm text-neutral-500 tracking-wide">
                    If you don't see the email in your inbox, check your spam folder.
                </div>
            </form>
        </div>
    </div>
@endsection