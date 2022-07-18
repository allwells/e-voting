@extends('layout.app')

@section('no-home', 'no-home')
@section('nav-border', 'nav-border')
@section('title', 'Reset Password')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-6 py-12 login-container lg:px-8">
        <div class="flex flex-col w-full max-w-lg gap-2">

            <x-error_message />

            <div>
                <h2 class="text-lg font-extrabold text-center uppercase sm:text-xl text-neutral-800">
                    Reset your password
                </h2>
            </div>

            <form id="login-for" class="flex flex-col gap-4 mt-5" action="{{ route('password.reset', [$token, $email]) }}"
                method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <input name="password" type="password"
                        class="relative block w-full px-3 mt-1 text-sm duration-300 border rounded h-11 text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                        placeholder="Choose a new password" required>
                </div>

                <div>
                    <input name="password_confirmation" type="password"
                        class="relative block w-full px-3 mt-1 text-sm duration-300 border rounded h-11 text-neutral-700 border-neutral-400 hover:border-neutral-700 focus:outline-none focus:border-indigo-600 focus:z-10"
                        placeholder="Confirm new password" required>
                </div>

                <div class="flex flex-col w-full gap-2 mt-1">
                    <button type="submit"
                        class="w-full py-3 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
