@extends('layout.layout')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Results Details
            </h2>

            <div class="mt-4 text-sm cursor-default text-neutral-700 md:text-base">
                <a href="{{ route('results') }}" class="text-indigo-600 cursor-pointer hover:underline">
                    Result
                </a>
                /
                <span class="text-neutral-400">Result Details</span>
            </div>

            <divl class="pb-6 cursor-default grow text-neutral-700 dark:text-neutral-200">
                <div class="w-full mt-10">
                    <h1 class="text-neutral-700 dark:text-neutral-200 text-md md:text-2xl font-bold mb-5 uppercase">
                        Results for {{ $election->title }}
                    </h1>

                    <!-- Chart's container -->
                    <div id="result-chart-canvas" class="h-96">
                    </div>
                </div>
            </divl </div>
        </div>
    @endsection

    @section('content')
        <!-- Application script -->
        <script>
            const chart = new Chartisan({
                el: '#result-chart-canvas',
                url: "@chart('chart', $election->id)",
                hooks: new ChartisanHooks()
                    .responsive()
                    .colors(['#ECC94B'])
                    // .borderColors()
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
