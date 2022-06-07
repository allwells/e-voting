@extends('layout.layout')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Results
            </h2>

            <divl class="pb-6 mt-6 cursor-default grow text-neutral-700 dark:text-neutral-200">
                <div class="w-full">
                    Results

                    <!-- Chart's container -->
                    <div id="result-chart-canvas" class="border border-rose-700 h-80"></div>
                </div>
            </divl </div>
        </div>
    @endsection
