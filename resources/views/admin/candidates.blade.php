@extends('layout.layout')

@section('title', 'Candidates')
@section('candidate-tab', 'active-candidate')

@section('views')
    <div class="flex flex-col items-center justify-start px-3 py-10 gap-y-16 h-fit lg:px-40">
        @if (auth() && auth()->user()->privilege == 'admin')
            <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
                <h2
                    class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                    Candidates
                </h2>
                <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                    <x-candidate_form :elections="$elections" />
                </div>
            </div>

            <div class="w-full min-h-full p-4 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
                <h2
                    class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-neutral-600 ring-1 ring-neutral-600 border-2 border-white cursor-default">
                    Candidate Details
                </h2>

                <div class="w-full min-h-full mt-10 tracking-wide dark:bg-neutral-700">
                    <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                        <thead
                            class="text-xs uppercase text-neutral-700 bg-neutral-50 dark:bg-neutral-700 dark:text-neutral-400">
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

                                <th scope="col" class="p-4 text-left">
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
