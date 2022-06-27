@extends('layout.layout')

@section('title', 'Results')
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-xl p-4 sm:p-5">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">View Election</label>

        <div class="overflow-x-auto">
            <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                <thead class="text-xs uppercase text-neutral-700 border-y">
                    <tr>
                        <th scope="col" class="text-center w-14">
                            S/N
                        </th>

                        <th scope="col" class="py-4 px-3 text-left">
                            Title
                        </th>

                        <th scope="col" class="py-4 px-3 text-left">
                            Description
                        </th>

                        <th scope="col" class="py-4 px-3 text-center"></th>
                    </tr>
                </thead>
                @if ($closed_elections->count() > 0)
                    <tbody class="border-b">
                        @foreach ($closed_elections as $index => $closed)
                            <x-result_table :index="$index" :election="$closed" />
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
