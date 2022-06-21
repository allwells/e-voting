@extends('layout.layout')

@section('title', "$election->title")
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-xl px-4 sm:px-5 py-5 sm:py-6">
        <div class="flex flex-col gap-1">
            <label class="text-neutral-600 font-medium text-sm sm:text-base">Election Details</label>
            <x-breadcrumbs previousPage="Elections" currentPage="Election Details" link="elections.view" />
        </div>

        <div class="border rounded-xl py-6 px-5">
            @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                <span class="mb-2 flex w-full items-center justify-start p-2.5 text-sm text-blue-700 rounded-md bg-blue-100">
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
                <h2 class="text-lg font-bold uppercase sm:text-xl">{{ $election->title }}</h2>

                @if ($election->type == 'close')
                    <span class="mb-2 flex items-center justify-start text-sm text-blue-700">
                        This is a <strong class="mx-1">close</strong> election!
                    </span>
                @endif

                <div class="flex flex-col justify-start gap-3 mt-4 text-xs md:flex-row md:gap-8 sm:text-sm text-neutral-50">
                    <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                        <label class="font-semibold text-neutral-700 dark:text-neutral-100">
                            @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                Starts:
                            @else
                                Started:
                            @endif
                        </label>
                        <div class="flex justify-start w-full gap-2 sm:w-fit">
                            {{-- Start date --}}
                            <span
                                class="bg-indigo-200 border border-indigo-600 rounded text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5">
                                <i class="fa fa-calendar"></i>
                                {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
                            </span>

                            {{-- Start time --}}
                            <span
                                class="bg-indigo-200 border border-indigo-600 rounded text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5">
                                <i class="fa fa-clock"></i>
                                {{ substr($election->start_date, 10, 6) }} UTC
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                        <label class="font-semibold text-neutral-700 dark:text-neutral-100">
                            @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                Ends:
                            @else
                                Ended:
                            @endif
                        </label>
                        <div class="flex justify-start w-full gap-2 sm:w-fit">
                            {{-- End date --}}
                            <span
                                class="bg-indigo-200 border border-indigo-600 rounded text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5">
                                <i class="fa fa-calendar"></i>
                                {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                            </span>

                            {{-- End time --}}
                            <span
                                class="bg-indigo-200 border border-indigo-600 rounded text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5">
                                <i class="fa fa-clock"></i>
                                {{ substr($election->end_date, 10, 6) }} UTC
                            </span>
                        </div>
                    </div>
                </div>

                <p class="mt-2 text-sm sm:text-base text-neutral-500 dark:text-neutral-300">
                    {{ $election->description }}</p>
            </div>

            {{-- Election candidates --}}
            <div class="flex flex-col gap-3 mt-8">
                <label class="text-neutral-600 font-medium text-sm sm:text-base">Candidates</label>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-neutral-500 dark:text-neutral-400">
                        <thead class="text-xs uppercase text-neutral-700 border-y">
                            <tr>
                                <th scope="col" class="text-center w-12">
                                    S/N
                                </th>

                                <th scope="col" class="py-4 px-2 text-left">
                                    Name
                                </th>

                                <th scope="col" class="py-4 px-2 text-left">
                                    Party
                                </th>

                                <th scope="col" class="py-4 text-center">
                                    Votes
                                </th>

                                <th scope="col" class="py-4 text-center w-20">
                                    @if (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
                                        <a href="{{ route('results.view', $election) }}"
                                            class="py-1 px-2 bg-neutral-100 rounded text-indigo-700 font-normal text-sm hover:bg-indigo-200 hover:text-indigo-800 hover:underline">
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

                {{-- @foreach ($candidates as $candidate)
                    <x-candidate_card :votes="$votes" :hasVoted="$hasVoted" :election="$election" :candidate="$candidate"
                        :today="$today" />
                @endforeach --}}
            </div>
        </div>
    </div>
@endsection
