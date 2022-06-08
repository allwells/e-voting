@extends('layout.layout')

@section('title', "$election->title")
@section('result-tab', 'active-results')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Results Details
            </h2>

            <div class="mt-4 text-sm cursor-default text-neutral-700 md:text-base">
                <a href="{{ route('results') }}" class="text-indigo-600 cursor-pointer hover:underline">
                    Results
                </a>
                /
                <span class="text-neutral-400">Result Details</span>
            </div>

            <div class="pb-6 cursor-default grow text-neutral-700 dark:text-neutral-200">
                <div class="w-full mt-10">
                    <h1 class="text-neutral-700 dark:text-neutral-200 text-md md:text-2xl font-bold mb-5 uppercase">
                        Results for {{ $election->title }}
                    </h1>

                    <!-- Chart's container -->
                    <div id="result-chart-canvas" class="h-96">
                    </div>
                </div>

                <div class="h-fit text-neutral-700 flex justify-stretch mt-3 items-center w-full gap-5 text-3xl">
                    <span class="text-lg">Share on social media:</span> {!! $share !!}
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
                .colors(['#ECC94B'])
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
