@extends('layout.layout')

@section('title', 'Results')
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="w-full px-1">
        <div class="w-full px-3 pb-3 bg-white overflow-y-auto overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-100 text-sm">
                        <th class="text-neutral-700 text-sm uppercase pr-2 text-left">Election Title</th>
                        <th class="text-neutral-700 text-sm uppercase px-4 py-4 text-left border-x border-neutral-100">
                            Description</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                @if ($closed_elections->count() > 0)
                    <tbody class="border-b border-neutral-100">
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

            <div class="px-3 mt-2.5 ">
                {{ $closed_elections->links() }}
            </div>
        </div>
    </div>
@endsection
