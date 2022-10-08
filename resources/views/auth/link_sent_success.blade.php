@extends('layout.app')

@section('no-home', 'no-home')
@section('nav-border', 'nav-border')
@section('title', 'Reset Password')

@section('content')
    <div id="page-content" class="flex items-center justify-center px-6 py-12 login-container lg:px-8">
        <div class="flex flex-col w-full max-w-lg gap-4 px-5 py-8 rounded-xl items-center justify-center">
            <svg class="w-24 h-24 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-2xl text-neutral-700 font-semibold tracking-wide hover:cursor-default">
                Link sent successfully!
            </span>

            <p class="text-sm text-neutral-600 font-medium tracking-wide">
                Check your email for your password reset link.
            </p>
        </div>
    </div>
@endsection
