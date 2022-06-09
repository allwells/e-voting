@extends('layout.layout')

@section('title', "$election->title")
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div
            class="w-full min-h-full px-0 py-3 tracking-wide bg-white border sm:px-4 border-neutral-100 dark:border-neutral-800 md:px-8 dark:bg-neutral-900 dark:ring-neutral-900 ring-1 ring-white">
            <x-live_heading text="Result Details" />

            <x-breadcrumbs previousPage="Results" currentPage="Result Details" link="results" />

            <div class="px-4 pb-6 mt-2 cursor-default grow sm:px-0 text-neutral-700 dark:text-neutral-200">
                <div class="w-full">
                    <h1 class="mb-5 font-bold uppercase text-neutral-700 dark:text-neutral-200 text-md md:text-2xl">
                        Results for {{ $election->title }}
                    </h1>

                    <!-- Chart's container -->
                    <div id="result-chart-canvas" class="h-96 dark:text-neutral-100 text-neutral-700">
                    </div>
                </div>

                <div
                    class="flex flex-col items-start w-full gap-2 mt-3 text-lg h-fit text-neutral-400 justify-stretch sm:items-center sm:gap-5 sm:text-3xl sm:flex-row">
                    <span class="text-sm sm:text-lg">Share on social media:</span> {!! $share !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

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
                .title('Results for {{ $election->title }} election')
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
