@extends('layout.layout')

@section('title', 'Results')
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-28">
        <div
            class="w-full min-h-full px-0 py-3 tracking-wide bg-white border sm:px-4 md:px-8 border-neutral-100 dark:bg-neutral-900 dark:border-neutral-800 dark:ring-neutral-900 ring-1 ring-white">
            <x-live_heading text="Results" />

            <div class="flex-grow pb-10 overflow-x-auto mt-7 text-neutral-500 dark:text-neutral-200">
                @if ($closed_elections->count() > 0)
                    <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                        <thead
                            class="text-xs uppercase text-neutral-700 border-neutral-200 dark:border-neutral-800 bg-neutral-200 dark:bg-neutral-800/50 dark:text-neutral-200">
                            <tr>
                                <th scope="col" class="p-4 text-left">
                                    Title
                                </th>

                                <th scope="col" class="py-4 pl-4 text-left border-neutral-200">
                                    Description
                                </th>

                                <th scope="col" class="p-4 text-center border-neutral-200">
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
