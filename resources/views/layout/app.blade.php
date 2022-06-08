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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </link>

</head>

<body class="h-full bg-neutral-100 dark:bg-neutral-800">
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

    <!-- Flowbite library -->
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
    <!-- Flowbite Datepicker library -->
    <script src="https://unpkg.com/flowbite@1.4.5/dist/datepicker.js"></script>
</body>

</html>
