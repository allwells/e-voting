@extends('layout.layout')

@section('title', 'Results')
@section('results-tab', auth()->user()->theme == 'dark' ? 'active-dark-results' : 'active-results')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        <label class="text-sm font-medium text-neutral-600 sm:text-base">View Election</label>

        <div class="overflow-x-auto">
            <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                <thead class="text-xs uppercase text-neutral-700 border-y">
                    <tr>
                        <th scope="col" class="text-center w-14">
                            S/N
                        </th>

                        <th scope="col" class="px-3 py-4 text-left">
                            Title
                        </th>

                        <th scope="col" class="px-3 py-4 text-left">
                            Description
                        </th>

                        <th scope="col" class="px-3 py-4 text-center"></th>
                    </tr>
                </thead>
                @if ($elections->count() > 0)
                    <tbody class="border-b">
                        @foreach ($elections as $index => $closed)
                            <x-result_table :index="$index + 1" :election="$closed" />
                        @endforeach
                    </tbody>
                @else
                    <tr class="text-base text-center text-neutral-600">
                        <td colspan="4" class="pt-12">No results to show.</td>
                    </tr>
                @endif
            </table>

            {{-- <div class="px-3 mt-2.5 ">
                {{ $elections->links() }}
            </div> --}}
        </div>
    </div>
@endsection
