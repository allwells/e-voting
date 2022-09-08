<!DOCTYPE html>
<html class=" h-full @auth {{ auth()->user()->theme }} @endauth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>@yield('title') | {{ config('app.name') }}</title>

    @if (env('APP_ENV') == 'production')
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body class="flex justify-center items-start w-full overflow-y-auto scrollbar-hide scroll-smooth">
    <main class="max-w-[1500px] w-full @auth bg-neutral-100 @endauth dark:bg-neutral-800 border-x">

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

        @if (env('APP_ENV') == 'production')
            <script src="{{ secure_asset('js/app.js') }}"></script>
            <script src="{{ secure_asset('js/datepicker.js') }}"></script>
        @else
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/datepicker.js') }}"></script>
        @endif
    </main>
</body>

</html>
