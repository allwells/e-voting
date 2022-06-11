@extends('layout.layout')

@section('title', 'Candidates')
@section('candidate-tab', auth()->user()->theme == 'dark' ? 'active-dark-candidate' : 'active-candidate')

@section('views')
    <div class="flex flex-col items-center justify-start px-3 py-10 gap-y-16 h-fit lg:px-28">
        @if (auth() && auth()->user()->privilege == 'admin')
            <div
                class="w-full min-h-full px-4 py-3 tracking-wide bg-white border rounded-lg shadow-lg shadow-neutral-300 dark:shadow-black border-neutral-100 dark:border-neutral-800 md:px-8 dark:bg-neutral-900 dark:ring-neutral-900 ring-1 ring-white">
                <x-live_heading text="Add Candidates" />

                <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                    <x-candidate_form :elections="$elections" />
                </div>
            </div>

            <div
                class="w-full min-h-full p-4 tracking-wide bg-white border rounded-lg shadow-lg md:px-8 shadow-neutral-300 dark:shadow-black dark:bg-neutral-900 border-neutral-100 dark:border-neutral-800 dark:ring-neutral-900 ring-1 ring-white">
                <div class="md:mt-4 sm:-mt-1">
                    <x-dead_heading text="Candidate Details" />
                </div>

                <div class="w-full min-h-full mt-10 mb-8 overflow-x-auto tracking-wide dark:bg-neutral-800">
                    <table class="w-full text-sm text-left cursor-default text-neutral-500 dark:text-neutral-400">
                        <thead
                            class="text-xs uppercase text-neutral-700 bg-neutral-50 dark:bg-neutral-800 dark:text-neutral-300">
                            <tr>
                                <th scope="col" class="w-8 p-4 text-center">
                                    ID
                                </th>

                                <th scope="col" class="p-4 text-left">
                                    Name
                                </th>

                                <th scope="col" class="p-4 text-left">
                                    Party
                                </th>

                                <th scope="col" class="p-4 text-center">
                                    Votes
                                </th>
                            </tr>
                        </thead>
                        @if ($candidates->count() > 0)
                            <tbody>
                                @foreach ($candidates as $candidate)
                                    <x-candidate_table :candidate="$candidate" :votes="$votes" />
                                @endforeach
                            </tbody>
                        @else
                            <tr class="text-lg text-center text-neutral-500">
                                <td colspan="4" class="pt-10">
                                    No candidate have been selected.
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
