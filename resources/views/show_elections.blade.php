@extends('layout.layout')

@section('title', "$election->title")
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="flex flex-col w-full gap-5 px-4 py-5 bg-white rounded-xl sm:px-5 sm:py-6">
        <x-error_message />
        <x-success_message />

        <div class="flex flex-col gap-1">
            <label class="text-sm font-medium text-neutral-600 sm:text-base">Election Details</label>
            <x-breadcrumbs previousPage="Elections" currentPage="Election Details" link="elections.view" />
        </div>

        <div class="flex flex-col w-full gap-5 md:flex-row-reverse">
            @if ($election->type == 'private')
                <div class="flex flex-col w-full py-3 border rounded-xl border-neutral-200 md:w-1/4 h-fit">
                    <div class="px-3">
                        <h1 class="m-0 text-base font-semibold text-neutral-800">Election Code:</h1>
                    </div>

                    <div class="my-2 border-b"></div>

                    <div class="flex flex-row items-center justify-between px-3">
                        <p id="text-to-copy" class="flex-grow text-xl font-medium text-indigo-600">
                            {{ $election->accessCode }}
                        </p>

                        <button type="button"
                            class="p-1 rounded copy-btn bg-tranparent text-neutral-500 hover:text-neutral-800 focus:text-neutral-800 focus:bg-neutral-300 hover:bg-neutral-200 w-fit h-fit">
                            <svg class="w-5 h-5 copy-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    @if (auth()->user()->privilege == 'admin' || auth()->user()->privilege == 'superuser')
                        <div class="my-2 border-b"></div>

                        <div class="flex items-center justify-between w-full gap-1 px-4">
                            <div class="text-emerald-600">
                                <span
                                    class="text-xs font-medium uppercase @if ($election->codeStatus == 'inactive') text-rose-600 @endif">
                                    {{ $election->codeStatus }}
                                </span>
                            </div>

                            <form action="{{ route('activation', $election) }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="p-0 text-sm font-medium transition duration-300 bg-transparent text-neutral-500 hover:text-neutral-800"
                                    title="{{ $election->codeStatus == 'active' ? 'Deactivate' : 'Activate' }} election code">
                                    {{ $election->codeStatus == 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endif

            <div class="w-full px-5 py-6 border rounded-xl md:w-3/4">
                @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                    <span
                        class="mb-2 flex w-full items-center justify-start p-2.5 text-sm text-blue-700 rounded-md bg-blue-100">
                        <svg class="w-5 h-5 mr-1 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        This election has <strong class="mx-1">ended!</strong>
                    </span>
                @elseif ($election->status == 'closed')
                    <span
                        class="mb-2 flex w-full items-center justify-start p-2.5 text-sm text-blue-700 rounded-md bg-blue-100">
                        <svg class="w-5 h-5 mr-1 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        This election was <strong class="mx-1">closed</strong> by an admin!
                    </span>
                @endif

                {{-- Election details --}}
                <div>
                    <div class="flex items-center justify-between">
                        <h1 class="flex items-center text-xl font-semibold text-neutral-800">
                            {{ $election->title }}

                            @if ($election->type == 'private')
                                <span class="flex items-center justify-center text-red-600 w-fit h-fit"
                                    title="This election is private">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @endif
                        </h1>
                        <span class="text-sm text-neutral-500"> posted
                            {{ $election->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="flex flex-col justify-start gap-3 mt-2 text-xs md:flex-row md:gap-3 text-neutral-600">
                        <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                            <div class="flex justify-start w-full gap-2 font-medium sm:w-fit">
                                {{-- Start date --}}
                                <span>
                                    <i class="text-indigo-700 fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
                                </span>

                                {{-- Start time --}}
                                <span>
                                    <i class="text-indigo-700 fa fa-clock"></i>
                                    {{ substr($election->start_date, 10, 6) }} UTC
                                </span>
                            </div>
                        </div>

                        <span>to</span>

                        <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                            <div class="flex justify-start w-full gap-2 font-medium sm:w-fit">
                                {{-- End date --}}
                                <span>
                                    <i class="text-indigo-700 fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                                </span>

                                {{-- End time --}}
                                <span>
                                    <i class="text-indigo-700 fa fa-clock"></i>
                                    {{ substr($election->end_date, 10, 6) }} UTC
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="mt-2 text-sm sm:text-base text-neutral-600 dark:text-neutral-300">
                        {{ $election->description }}</p>
                </div>

                {{-- Election candidates --}}
                <div class="flex flex-col gap-3 mt-8">
                    <label class="text-sm font-medium text-neutral-600 sm:text-base">Candidates</label>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-neutral-500 dark:text-neutral-400">
                            <thead class="text-xs uppercase text-neutral-700 border-y">
                                <tr>
                                    <th scope="col" class="w-12 text-center">
                                        S/N
                                    </th>

                                    <th scope="col" class="px-2 py-4 text-left">
                                        Name
                                    </th>

                                    <th scope="col" class="px-2 py-4 text-left">
                                        Party
                                    </th>

                                    <th scope="col" class="py-4 text-center">
                                        Votes
                                    </th>

                                    <th scope="col" class="w-20 py-4 text-center">
                                        @if (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
                                            <a href="{{ route('results.view', $election) }}"
                                                class="px-2 py-1 text-sm font-normal text-indigo-700 rounded bg-neutral-100 hover:bg-indigo-200 hover:text-indigo-800 hover:underline">
                                                Results
                                            </a>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            @if ($candidates->count() > 0)
                                <tbody class="border-b">
                                    @foreach ($candidates as $index => $candidate)
                                        <x-candidate_table :index="$index + 1" :candidate="$candidate" :votes="$votes"
                                            :today="$today" :voted="$voted" :election="$election" />
                                    @endforeach
                                </tbody>
                            @else
                                <tr class="text-base text-center cursor-default sm:text-lg text-neutral-500">
                                    <td colspan="4" class="pt-10">
                                        No candidates for this election yet.
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
