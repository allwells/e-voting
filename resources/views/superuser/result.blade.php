@extends('layout.layout')

@section('title', 'Election Results')
@section('results-tab', Auth::user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5"><label
            class="text-sm font-bold text-neutral-700 sm:text-base">Election Results</label>

        <x-success_message />
        <x-error_message />
        <x-warning_message />
        <x-info_message />

        <div class="flex items-center justify-center w-full">
            <x-result_search_form />
        </div>

        <div class="overflow-x-auto overflow-y-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-sm font-semibold uppercase border-y text-neutral-700">
                        <th class="py-4 text-center w-14">S/N</th>
                        <th class="px-2 py-4 text-left">@sortablelink('title', 'Title')</th>
                        <th class="px-2 py-4 text-left">Description</th>
                        <th class="w-20 px-2 py-4 text-center">@sortablelink('type', 'Privacy')</th>
                        <th class="w-24 px-2 py-4 text-center">Candidates</th>
                        <th class="w-16 px-2 py-4 text-center">Votes</th>
                        <th class="w-16 px-2 py-4 text-center">Action</th>
                    </tr>
                </thead>

                @if ($elections->count() > 0)
                    <tbody id="results-content" class="text-neutral-600">
                        @foreach ($elections as $index => $election)
                            <x-dashboard_results_table :index="$index + 1" :result="$election" :hasDescription="true"
                                :hasPrivacy="true" />
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="6" class="py-10 text-center">
                            <span class="text-base tracking-wider text-neutral-500">No results.</span>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
