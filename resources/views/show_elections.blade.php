@extends('layout.layout')

@section('title', "$election->title")
@section('election-tab', 'active-election')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-24">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Election Details
            </h2>

            <div class="mt-4 text-sm cursor-default text-neutral-700 md:text-base">
                <a href="{{ route('elections') }}" class="text-indigo-600 cursor-pointer hover:underline">
                    Elections
                </a>
                /
                <span class="text-neutral-400">Election Details</span>
            </div>

            <div class="pb-6 mt-3 cursor-default grow text-neutral-700 dark:text-neutral-200">
                @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                    <span
                        class="mb-2 flex w-full items-center justify-start px-2 py-0.5 text-sm sm:text-base border-2 border-white text-rose-700 bg-rose-100 ring-1 ring-rose-100 dark:border-neutral-900">
                        <svg class="w-5 h-5 sm:h-6 sm:w-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        This election has <strong class="mx-1">ended</strong>!
                    </span>
                @endif
                {{-- Election details --}}
                <div>
                    <h2 class="text-lg font-bold uppercase sm:text-2xl">{{ $election->title }}</h2>

                    @if ($election->type == 'close')
                        <span
                            class="mt-2 flex w-full sm:w-fit items-center justify-start text-xs text-indigo-700 md:text-sm">
                            This is a <strong class="mx-1">close</strong> election!
                        </span>
                    @endif

                    <div
                        class="flex flex-col mt-4 md:flex-row justify-start gap-0 md:gap-8 text-xs sm:text-sm text-neutral-50">
                        <div class="flex w-full sm:w-fit gap-1 sm:gap-2 items-start sm:items-center flex-col sm:flex-row">
                            <label class="text-neutral-700 dark:text-neutral-100 font-semibold">
                                @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                    Starts:
                                @else
                                    Started:
                                @endif
                            </label>
                            <div class="flex gap-2 w-full sm:w-fit justify-between sm:justify-start">
                                {{-- Start date --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:border-neutral-900">
                                    <i class="fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
                                </span>

                                {{-- Start time --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:border-neutral-900">
                                    <i class="fa fa-clock"></i>
                                    {{ substr($election->start_date, 10, 6) }} UTC
                                </span>
                            </div>
                        </div>

                        <div class="flex w-full sm:w-fit gap-1 sm:gap-2 items-start sm:items-center flex-col sm:flex-row">
                            <label class="text-neutral-700 dark:text-neutral-100 font-semibold">
                                @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                                    Ends:
                                @else
                                    Ended:
                                @endif
                            </label>
                            <div class="flex gap-2 w-full sm:w-fit justify-between sm:justify-start">
                                {{-- End date --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:border-neutral-900">
                                    <i class="fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                                </span>

                                {{-- End time --}}
                                <span
                                    class="bg-indigo-200 border-2 border-white text-indigo-700 font-semibold py-0.5 px-1.5 ring-1 ring-indigo-100 dark:border-neutral-900">
                                    <i class="fa fa-clock"></i>
                                    {{ substr($election->end_date, 10, 6) }} UTC
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="mt-2 text-sm sm:text-base text-neutral-500">{{ $election->description }}</p>
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
