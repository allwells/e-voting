<!DOCTYPE html>
<html class=" h-full @auth {{ auth()->user()->mode }}  @endauth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>{{ config('app.name', 'e-Voting') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </link>

</head>

<body class="h-full bg-white @auth dark:bg-neutral-800 @endauth">
    {{-- Navbar for authenticated users --}}
    @auth
        <div class="{{ auth()->user()->mode }} h-fit fixed w-full z-50">
            <x-auth_nav />
        </div>
    @endauth

    {{-- Navbar for non-authenticated users --}}
    @guest
        <x-navbar />
    @endguest

    {{-- Main --}}
    @yield('content')

    {{-- Footer --}}
    @guest
        <x-footer />
    @endguest

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
</body>

</html>
