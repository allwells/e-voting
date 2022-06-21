@extends('layout.layout')

@section('title', 'View Elections')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-xl p-4 sm:p-5">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">View Election</label>

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
