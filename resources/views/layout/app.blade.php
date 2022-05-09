<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>e-Voting</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">

</head>

<body class="h-full">
    {{-- Navbar --}}
    <x-navbar />

    {{-- Main --}}
    @yield('content')

    {{-- Footer --}}
    <x-footer />
</body>

</html>
