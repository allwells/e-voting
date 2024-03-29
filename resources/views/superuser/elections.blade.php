@extends('layout.layout')

@section('title', 'View Elections')
@section('election-tab', Auth::user()->theme == 'dark' ? 'active-dark-election' : 'active-election')
@section('view-elections-sub-tab', 'view-elections-sub-tab')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        {{-- FOR SUPERUSER ELECTION PAGE --}}
        @if (Auth::user()->role === 'super admin')
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-start justify-start w-full">
                    <label class="text-sm font-bold text-neutral-600 sm:text-base">View Elections</label>

                    <x-error_message />
                    <x-success_message />
                </div>

                @if (Auth::user()->role === 'admin')
                    <a href={{ route('elections.create') }}
                        class="flex items-center justify-center gap-3 p-1 text-white bg-[#0000FF] rounded shadow-lg hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-indigo-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                            </path>
                        </svg>
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-center w-full">
                <x-election_search_form />
            </div>

            <div class="overflow-x-auto">
                <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                    <thead class="text-sm font-medium uppercase text-neutral-700 border-y">
                        <tr>
                            <th scope="col" class="px-3 text-center w-14">
                                S/N
                            </th>

                            <th scope="col" class="py-4 pl-3 text-left">
                                @sortablelink('title', 'Title')
                            </th>

                            <th scope="col" class="py-4 pl-3 text-left">
                                Description
                            </th>

                            <th scope="col" class="py-4 text-center w-14">
                                @sortablelink('type', 'Type')
                            </th>

                            <th scope="col" class="w-20 py-4 text-center">
                                Status
                            </th>

                            <th scope="col" class="w-16 px-1 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @if ($elections->count() > 0)
                        <tbody id="elections-content" class="border-b">
                            @foreach ($elections as $index => $election)
                                <x-election_table :index="$index + 1" :election="$election" :today="$today" :hasDescription="true" />
                            @endforeach
                        </tbody>
                    @else
                        <tr class="text-base text-center cursor-default text-neutral-500">
                            <td colspan="6" class="pt-10">
                                Nothing to show.
                            </td>
                        </tr>
                    @endif
                </table>

                <div class="px-3 pt-2.5">
                    {!! $elections->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        @endif
    </div>
@endsection
