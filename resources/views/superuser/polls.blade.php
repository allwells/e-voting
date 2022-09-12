@extends('layout.layout')

@section('title', 'Polls')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')
@section('view-polls-sub-tab', 'view-polls-sub-tab')

@section('views')
    {{-- <div class="flex flex-col w-full gap-5 px-2 bg-white rounded-2xl sm:p-5">
        <h2 class="text-xl md:text-3xl text-[#0000FF] font-bold">Polls</h2>
        @if ($polls->count() > 0)
            @foreach ($polls as $poll)
                <x-polls_card :poll="$poll" :options="$options" :responses="$responses" />
            @endforeach
        @else
            <div class="w-full relative py-10 text-center text-sm text-neutral-600 flex justify-center items-center">
                No polls yet.
            </div>
        @endif
    </div> --}}


    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        <label class="text-sm font-bold text-neutral-700 sm:text-base">Polls</label>

        <x-success_message />
        <x-error_message />
        <x-warning_message />
        <x-info_message />

        <div class="flex items-center justify-center w-full">
            <x-poll_search_form />
        </div>

        <div class="overflow-x-auto overflow-y-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs uppercase border-y text-neutral-700">
                        <th class="px-2 py-4 text-center">S/N</th>
                        <th class="px-2 py-4 text-left">Poll Question</th>
                        <th class="px-2 py-4 text-center">Total Responses</th>
                        <th class="px-2 py-4 text-center">Action</th>
                    </tr>
                </thead>
                @if ($polls->count() > 0)
                    <tbody id="polls-content" class="text-sm border-b text-neutral-600">
                        @foreach ($polls as $index => $poll)
                            <x-polls_table :index="$index + 1" :poll="$poll" :today="$today" />
                        @endforeach
                    </tbody>
                @else
                    <td class="text-sm border-b text-neutral-600">
                        No polls.
                    </td>
                @endif
            </table>
        </div>
    </div>
@endsection
