@extends('layout.layout')

@section('title', 'Elections')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div
        class="flex flex-col items-center justify-start @if (auth() && auth()->user()->privilege == 'admin') ) gap-16 @endif px-3 py-10 h-fit lg:px-28">
        @if (auth() && auth()->user()->privilege == 'admin')
            <div
                class="w-full min-h-full px-0 py-3 tracking-wide bg-white border sm:px-4 border-neutral-100 dark:border-neutral-800 md:px-8 dark:bg-neutral-900 dark:ring-neutral-900 ring-1 ring-white">
                <x-live_heading text="Create Elections" />

                <div class="px-4 pb-6 mt-6 sm:px-0 grow text-neutral-500 dark:text-neutral-200">
                    <x-election_form />
                </div>
            </div>
        @endif

        <div
            class="w-full min-h-full px-0 py-4 tracking-wide bg-white border md:p-8 dark:bg-neutral-900 border-neutral-100 dark:border-neutral-800 dark:ring-neutral-900 ring-1 ring-white">
            @if (auth() && auth()->user()->privilege == 'user')
                <div class="-mt-2 md:-mt-14">
                    <x-live_heading text="Elections" />
                </div>
            @endif

            @if (auth() && auth()->user()->privilege == 'admin')
                <x-dead_heading text="Elections" />
            @endif

            <div class="@if (auth() && auth()->user()->privilege == 'user') mt-10 @endif overflow-x-auto">
                <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                    <thead
                        class="text-xs uppercase border-t text-neutral-700 border-x border-neutral-200 dark:border-neutral-800 bg-neutral-200 dark:bg-neutral-800/50 dark:text-neutral-200">
                        <tr>
                            <th scope="col" class="p-4 text-left">
                                Title
                            </th>

                            <th scope="col" class="py-4 pl-4 text-left border-l border-neutral-100 dark:border-neutral-800">
                                Description
                            </th>

                            <th scope="col" class="py-4 pl-4 text-left border-l border-neutral-100 dark:border-neutral-800">
                                Status
                            </th>

                            <th scope="col" class="p-4 text-left border-x border-neutral-100 dark:border-neutral-800">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @if ($elections->count() > 0)
                        <tbody>
                            @foreach ($elections as $election)
                                <x-election_table :election="$election" :today="$today" />
                            @endforeach
                        </tbody>
                    @else
                        <tr class="text-lg text-center cursor-default text-neutral-500">
                            <td colspan="4" class="pt-10">
                                No elections yet.
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
