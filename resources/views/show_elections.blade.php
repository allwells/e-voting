@extends('layout.layout')

@section('title', "$election->title")
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div
            class="w-full min-h-full px-0 py-3 tracking-wide bg-white border sm:px-4 border-neutral-100 dark:border-neutral-800 md:px-8 dark:bg-neutral-900 dark:ring-neutral-900 ring-1 ring-white">
            <x-live_heading text="Election Details" />

            <x-breadcrumbs previousPage="Elections" currentPage="Election Details" link="elections" />

            <div class="px-4 pb-6 mt-3 cursor-default sm:px-0 grow text-neutral-700 dark:text-neutral-200">
                @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                    <span
                        class="mb-2 flex w-full items-center justify-start px-2 py-0.5 text-sm sm:text-base border-2 border-white text-rose-700 dark:text-rose-100 bg-rose-100 dark:bg-rose-600 ring-1 ring-rose-100 dark:ring-rose-600 dark:border-neutral-900">
                        <svg class="w-5 h-5 mr-1 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        This election has <strong class="mx-1">ended</strong>!
                    </span>
                @elseif ($election->status == 'closed')
                    <span
                        class="mb-2 flex w-full items-center justify-start px-2 py-0.5 text-sm sm:text-base border-2 border-white text-rose-700 dark:text-rose-100 bg-rose-100 dark:bg-rose-600 ring-1 ring-rose-100 dark:ring-rose-600 dark:border-neutral-900">
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
                    <div class="flex items-start justify-between break-words break-all">
                        <h2 class="text-lg font-bold uppercase sm:text-2xl">{{ $election->title }}</h2>
                        @if (auth() && auth()->user()->privilege == 'admin')
                            @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                <x-edit_election_modal :election="$election" />
                            @endif
                        @endif
                    </div>

                    @if ($election->type == 'close')
                        <span
                            class="flex items-center justify-start w-full mt-2 text-xs text-indigo-700 sm:w-fit dark:text-indigo-500 md:text-sm">
                            This is a <strong class="mx-1">close</strong> election!
                        </span>
                    @endif

                    <div
                        class="flex flex-col justify-start gap-3 mt-4 text-xs md:flex-row md:gap-8 sm:text-sm text-neutral-50">
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
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:ring-indigo-600 dark:border-neutral-900">
                                    <i class="fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
                                </span>

                                {{-- Start time --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:ring-indigo-600 dark:border-neutral-900">
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
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:ring-indigo-600 dark:border-neutral-900">
                                    <i class="fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                                </span>

                                {{-- End time --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 dark:text-indigo-100 dark:bg-indigo-600 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:ring-indigo-600 dark:border-neutral-900">
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
                <div class="flex flex-wrap items-start justify-start w-full gap-4 mt-10">
                    @foreach ($candidates as $candidate)
                        <x-candidate_card :votes="$votes" :hasVoted="$hasVoted" :election="$election" :candidate="$candidate"
                            :today="$today" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
