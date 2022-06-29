@extends('layout.layout')

@section('title', 'View Elections')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')
@section('view-elections-sub-tab', 'view-elections-sub-tab')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-xl p-4 sm:p-5">
        <div class="flex justify-between items-center">
            <label class="text-neutral-600 font-medium text-sm sm:text-base">View Elections</label>

            @if (auth()->user()->privilege === 'admin')
                <a href={{ route('elections.create') }}
                    class="flex items-center justify-center gap-3 p-1 text-white bg-indigo-600 rounded shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                <thead class="text-xs uppercase text-neutral-700 border-y">
                    <tr>
                        <th scope="col" class="text-center px-3">
                            S/N
                        </th>

                        <th scope="col" class="p-4 text-left">
                            Title
                        </th>

                        <th scope="col" class="py-4 pl-4 text-left">
                            Description
                        </th>

                        <th scope="col" class="py-4 pl-4 text-left">
                            Status
                        </th>

                        <th scope="col" class="px-1 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                @if ($elections->count() > 0)
                    <tbody class="border-b">
                        @foreach ($elections as $index => $election)
                            <x-election_table :index="$index + 1" :election="$election" :today="$today" />
                        @endforeach
                    </tbody>
                @else
                    <tr class="text-base text-center cursor-default sm:text-lg text-neutral-500">
                        <td colspan="4" class="pt-10">
                            No elections yet.
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
