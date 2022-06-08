@extends('layout.layout')

@section('title', 'Results')
@section('result-tab', 'active-results')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-28">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-9 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Results
            </h2>
            <div class="flex-grow pb-10 mt-7 text-neutral-500 dark:text-neutral-200 overflow-x-auto">
                @if ($closed_elections->count() > 0)
                    <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                        <thead
                            class="text-xs uppercase text-neutral-700 border-neutral-200 bg-neutral-200 dark:bg-neutral-700 dark:text-neutral-400">
                            <tr>
                                <th scope="col" class="p-4 text-left">
                                    Title
                                </th>

                                <th scope="col" class="py-4 pl-4 text-left border-neutral-200">
                                    Description
                                </th>

                                <th scope="col" class="p-4 text-left border-neutral-200">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($closed_elections as $closed)
                                <x-result_table :election="$closed" />
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="w-full h-full mt-10 text-lg text-center text-neutral-500 dark:text-neutral-400">
                        No results yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
