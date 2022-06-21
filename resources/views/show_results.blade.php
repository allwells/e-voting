@extends('layout.layout')

@section('title', "$election->title")
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="w-full px-1">
        <x-breadcrumbs previousPage="Results" currentPage="Result Details" link="results" />

        <div class="pb-6 mt-2 cursor-default grow text-neutral-700">
            <div class="w-full">
                <h1 class="mb-3 font-bold uppercase text-neutral-700 text-base md:text-xl">
                    Results for {{ $election->title }}
                </h1>

                <!-- Chart's container -->
                <div id="result-chart-canvas" class="h-96 dark:text-neutral-100 text-neutral-700">
                </div>
            </div>

            <div
                class="flex flex-col items-start w-full gap-2 mt-3 text-lg h-fit text-neutral-600 justify-stretch sm:items-center sm:text-xl sm:flex-row">
                <span class="text-sm sm:text-base dark:text-neutral-200">Share on social media:</span>
                <span id="social-links">{!! $share !!}</span>
            </div>
        </div>
    </div>

    {{-- REMOVE COMMENTS BEFORE DEPLOYMENT --}}
    {{-- <script src="{{ secure_asset('js/app.js') }}"></script> --}}

    {{-- For localhost - COMMENT THIS BEFORE DEPLOYMENT --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Application script -->
    <script>
        const chart = new Chartisan({
            el: '#result-chart-canvas',
            url: "@chart('chart', $election->id)",
            hooks: new ChartisanHooks()
                .responsive()
                .colors(["#5850ec"])
                .beginAtZero()
                .legend({
                    position: 'bottom'
                })
                .datasets('bar'),
            loader: {
                color: '#3958AA',
                size: [30, 30],
                type: 'bar',
                textColor: '#3958AA',
                text: 'Loading election results...',
            },
            error: {
                color: 'rgb(190 18 60)',
                size: [30, 30],
                text: 'Oops! There was an error loading results...',
                textColor: 'rgb(190 18 60)',
                type: 'general',
                debug: false,
            }
        });
    </script>
@endsection
