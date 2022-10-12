@extends('layout.layout')

@section('title', 'Results for ' . $election->title)
@section('results-tab', Auth::user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-2xl px-4 sm:px-5 py-5 sm:py-6">
        <div class="flex flex-col gap-1">
            <h2 class="text-3xl text-[#0000FF] font-bold">Result Details</h2>

            <div class="cursor-default text-neutral-700 text-xs">
                <a href='{{ route('results') }}' class="text-[#0000FF] cursor-pointer underline">
                    Results
                </a>
                <span class="mx-1">•</span>
                <a href='{{ route('elections.show', $election) }}' class="text-[#0000FF] cursor-pointer underline">
                    {{ $election->title }}
                </a>
                <span class="mx-1">•</span>
                <span class="text-neutral-500">Result Details</span>
            </div>
        </div>

        <div class="pb-6 mt-2 cursor-default grow text-neutral-700">
            <div class="w-full">
                <h1 class="mb-3 font-bold uppercase text-neutral-700 text-sm md:text-base">
                    Showing Results for <a href="{{ route('elections.show', $election) }}"
                        class="text-[#0000FF] hover:underline">{{ $election->title }}</a>
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

    @if (env('APP_ENV') == 'production')
        <script src="{{ secure_asset('js/app.js') }}"></script>
    @else
        <script src="{{ asset('js/app.js') }}"></script>
    @endif

    <!-- Application script -->
    <script>
        const chart = new Chartisan({
            el: '#result-chart-canvas',
            url: "@chart('chart', $election->id)",
            hooks: new ChartisanHooks()
                .responsive()
                .colors(["#0000FF"])
                .beginAtZero()
                .legend({
                    position: 'bottom'
                })
                .datasets('bar'),
            loader: {
                color: '#0000FF',
                size: [30, 30],
                type: 'bar',
                textColor: '#0000FF',
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
