<!DOCTYPE html>
<html class=" h-full @auth {{ auth()->user()->theme }}  @endauth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>{{ config('app.name') }} ● @yield('title')</title>

    <!-- Styles -->
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    @if (env('APP_ENV') == 'production')
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </link>

</head>

<body class="@auth bg-neutral-100 @endauth dark:bg-neutral-800">
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

    {{-- REMOVE COMMENTS BEFORE DEPLOYMENT --}}
    {{-- <script src="{{ secure_asset('js/app.js') }}"></script> --}}

    {{-- For localhost - COMMENT THIS BEFORE DEPLOYMENT --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Flowbite library -->
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
    <!-- Flowbite Datepicker library -->
    <script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
</body>

</html>
