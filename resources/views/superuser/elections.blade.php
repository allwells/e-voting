@extends('layout.layout')

@section('title', 'View Elections')
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')
@section('view-elections-sub-tab', 'view-elections-sub-tab')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        {{-- FOR ADMIN AND SUPERUSER --}}
        @if (auth()->user()->privilege == 'admin' || auth()->user()->privilege == 'superuser')
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-neutral-600 sm:text-base">View Elections</label>

                @if (auth()->user()->privilege === 'admin')
                    <a href={{ route('elections.create') }}
                        class="flex items-center justify-center gap-3 p-1 text-white bg-indigo-600 rounded shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                            </path>
                        </svg>
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                    <thead class="text-xs uppercase text-neutral-700 border-y">
                        <tr>
                            <th scope="col" class="px-3 text-center">
                                S/N
                            </th>

                            <th scope="col" class="p-4 text-left">
                                Title
                            </th>

                            <th scope="col" class="py-4 pl-4 text-left">
                                Description
                            </th>

                            <th scope="col" class="py-4 pl-4 text-left">
                                Type
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
        @endif

        {{-- FOR USERS(VOTERS) --}}
        @if (auth()->user()->privilege == 'user')
            <x-error_message />

            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-neutral-800">Elections</h3>

                @if (auth()->user()->privilege == 'user')
                    <div>
                        <button type="button" data-modal-toggle="election-code-modal"
                            class="flex items-center justify-center gap-2 px-4 py-2 text-sm text-white bg-indigo-600 rounded text-medium hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Join Private Election
                        </button>
                        <x-election_code_modal />
                    </div>
                @endif
            </div>

            <div
                class="flex flex-col items-center justify-start w-full gap-5 md:flex-row md:justify-between md:items-start">
                <div class="flex flex-col items-start justify-start w-full gap-5 pb-10 md:w-3/4">
                    @foreach ($participants as $participant)
                        @foreach ($elections as $election)
                            @if ($election->type === 'public' || ($participant->user_id == auth()->user()->id && $election->id == $participant->election_id))
                                <x-election_card :election="$election" />
                            @endif
                        @endforeach
                    @endforeach

                    {{-- @foreach ($participants as $participant)
                        @if ($participant->user_id == auth()->user()->id && $election->id == $participant->election_id)
                            <x-election_card :election="$election" />
                        @endif
                    @endforeach --}}

                    <div class="w-full mt-3 text-neutral-800">
                        {{ $electionList->links() }}
                    </div>
                </div>

                <div class="w-full p-4 pb-6 bg-white border rounded-lg md:w-1/4 h-fit border-neutral-200">
                    <h3 class="text-base font-medium text-neutral-800">Latest</h3>

                    <div class="flex flex-col gap-3 mt-3">
                        @foreach ($latestElection as $latest)
                            <p class="px-2 py-3 text-sm rounded-md text-neutral-700 hover:underline bg-neutral-100">
                                {{ $latest->title }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        @endif
    </div>
@endsection
