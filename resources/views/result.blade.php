@extends('layout.layout')

@section('title', 'Results')
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="w-full px-1">
        {{-- <x-live_heading text="Results" /> --}}


        {{-- <div class="flex-grow pb-10 overflow-x-auto mt-7 text-neutral-500 dark:text-neutral-200">
            @if ($closed_elections->count() > 0)
                <table class="w-full mb-8 text-sm bg-white text-left text-neutral-500 dark:text-neutral-400">
                    <thead class="text-xs border-b border-neutral-200 uppercase text-neutral-700">
                        <tr>
                            <th scope="col" class="p-4 text-left">
                                Election
                            </th>

                            <th scope="col" class="py-4 pl-2 text-left">
                                Description
                            </th>

                            <th scope="col" class="p-4 text-center">
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
                <div class="w-full h-full mt-10 text-base text-center sm:text-lg text-neutral-500 dark:text-neutral-400">
                    No results yet.
                </div>
            @endif
        </div> --}}


        <div class="w-full px-3 pb-3 bg-white overflow-y-auto overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-200 text-sm">
                        <th class="text-neutral-700 text-sm uppercase px-2 text-left">Election Title</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-left border-x">Description</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                @if ($closed_elections->count() > 0)
                    <tbody>
                        @foreach ($closed_elections as $closed)
                            <x-result_table :election="$closed" />
                        @endforeach
                    </tbody>
                @else
                    <tr class="text-base text-center text-neutral-600">
                        <td colspan="3" class="py-10">No results yet.</td>
                    </tr>
                @endif
            </table>

            {{-- <div class="px-3 mt-2 border-t border-neutral-200 pt-2.5">
                {{ $closed_elections->links() }}
            </div> --}}
        </div>
    </div>
@endsection
