@extends('layout.layout')

@section('title', "$election->title")
@section('election-tab', auth()->user()->theme == 'dark' ? 'active-dark-election' : 'active-election')

@section('views')
    <div class="flex flex-col w-full gap-5 px-3 py-5 bg-white rounded-xl sm:px-5 sm:py-6">
        <x-error_message />
        <x-success_message />
        <x-info_message />

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

            <div
                class="w-full px-3 py-4 sm:px-5 sm:py-6 border rounded-xl @if ($election->type == 'private') md:w-3/4 @endif">
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
                    <div class="flex items-start sm:items-center justify-start sm:justify-between sm:flex-row flex-col">
                        <h1 class="flex items-center text-xl font-semibold text-neutral-800 gap-1 flex-wrap">
                            {{ $election->title }}

                            @if ($election->type == 'private')
                                <span
                                    class="flex items-center justify-center bg-red-600 rounded-sm px-0.5 w-fit h-fit font-normal text-xs uppercase text-white"
                                    title="This election is private">
                                    private
                                </span>
                            @endif
                        </h1>
                        <span class="text-sm text-neutral-500">
                            posted {{ $election->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="flex flex-col justify-start gap-1 mt-2 text-xs sm:flex-row sm:gap-3 text-neutral-600">
                        <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                            <div class="flex justify-start w-full gap-2 font-medium sm:w-fit">
                                {{-- Start date --}}
                                <span>
                                    <i class="text-neutral-600 fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
                                </span>

                                {{-- Start time --}}
                                <span>
                                    <i class="text-neutral-600 fa fa-clock"></i>
                                    {{ substr($election->start_date, 10, 6) }}
                                </span>
                            </div>
                        </div>

                        <span>to</span>

                        <div class="flex flex-col items-start w-full gap-1 sm:w-fit sm:gap-2 sm:items-center sm:flex-row">
                            <div class="flex justify-start w-full gap-2 font-medium sm:w-fit">
                                {{-- End date --}}
                                <span>
                                    <i class="text-neutral-600 fa fa-calendar"></i>
                                    {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
                                </span>

                                {{-- End time --}}
                                <span>
                                    <i class="text-neutral-600 fa fa-clock"></i>
                                    {{ substr($election->end_date, 10, 6) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="mt-2 text-sm sm:text-base text-neutral-600 dark:text-neutral-300">
                        {{ $election->description }}</p>
                </div>

                {{-- Election candidates --}}
                <div class="flex flex-col gap-3 mt-8">
                    <div class="flex justify-between items-center">
                        <label class="text-sm font-medium text-neutral-600">Candidates</label>

                        @if (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
                            <a href="{{ route('results.view', $election) }}"
                                class="px-2 py-1 text-sm font-normal text-indigo-700 rounded bg-neutral-100 hover:bg-indigo-200 hover:text-indigo-800 hover:underline">
                                View Results
                            </a>
                        @endif
                    </div>

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
                                <tr class="text-sm text-center cursor-default sm:text-lg text-neutral-500">
                                    <td colspan="4" class="pt-10">
                                        No candidates for this election yet.
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                    @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
                        <form action="{{ route('import.file', $election) }}" method="post" enctype="multipart/form-data"
                            class="mt-10">
                            @csrf

                            <div class="flex flex-col justify-start w-full form-input-group">
                                <label for="imported_file" class="text-sm font-medium text-neutral-600">
                                    Import Participants
                                </label>

                                <span class="mt-1 text-xs tracking-wide text-neutral-500">
                                    Import file containing dataset of only individuals that will participate in this
                                    election.
                                </span>

                                <div class="flex items-center justify-start sm:flex-row flex-col gap-3 mt-2">
                                    <input name="imported_file" type="file" id="imported_file"
                                        aria-describedby="file_input_help"
                                        class="flex-grow px-3 mt-1 w-full text-xs transition duration-300 bg-transparent border rounded sm:text-sm border-neutral-200 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-400 focus:border-indigo-600"
                                        required>

                                    <button type="submit"
                                        class="w-full px-5 py-2.5 text-sm flex justify-center gap-2 items-center font-normal text-white bg-indigo-600 rounded shadow-lg sm:w-fit hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Upload
                                    </button>
                                </div>

                                <span class="mt-2 text-xs tracking-wide text-neutral-500">
                                    File format must be <strong>.csv</strong>, <strong>.xls</strong> or
                                    <strong>.xlsx</strong>
                                </span>
                            </div>
                        </form>
                    @endif
                @endif

                @if ($election->type == 'private')
                    {{-- Election participants --}}
                    <div class="flex flex-col gap-3 mt-8">
                        <label class="text-sm font-medium text-neutral-600">Participants</label>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-neutral-500 dark:text-neutral-400">
                                <thead>
                                    <tr class="text-xs uppercase border-y text-neutral-700">
                                        <th class="w-12 px-2 py-4 text-center">S/N</th>
                                        <th class="px-2 py-4 text-left">Name</th>
                                        <th class="px-2 py-4 text-left">Email</th>

                                        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
                                            <th scope="col" class="w-14">
                                                <span class="flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"
                                                        class="w-6 h-6">
                                                        <g data-name="User Settings">
                                                            <g data-name="&lt;Group&gt;">
                                                                <path fill="none" stroke="#303c42"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M23.5,19.5v-2l-1.24-.31a4,4,0,0,0-.17-.43l.65-1.09-1.41-1.41-1.09.65a4,4,0,0,0-.43-.17L19.5,13.5h-2l-.31,1.24a4,4,0,0,0-.43.17l-1.09-.65-1.41,1.41.65,1.09a4,4,0,0,0-.17.43l-1.24.31v2l1.24.31a4,4,0,0,0,.17.43l-.65,1.09,1.41,1.41,1.09-.65a4,4,0,0,0,.43.17l.31,1.24h2l.31-1.24a4,4,0,0,0,.43-.17l1.09.65,1.41-1.41-.65-1.09a4,4,0,0,0,.17-.43Z"
                                                                    data-name="&lt;Path&gt;" />
                                                                <circle cx="18.5" cy="18.5" r="2"
                                                                    fill="none" stroke="#303c42"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    data-name="&lt;Path&gt;" />
                                                            </g>
                                                            <g data-name="&lt;Group&gt;">
                                                                <circle cx="11" cy="6" r="5.5"
                                                                    fill="none" stroke="#303c42"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    data-name="&lt;Path&gt;" />
                                                                <path fill="none" stroke="#303c42"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.17,14.75A17.26,17.26,0,0,0,11,13.5a18.74,18.74,0,0,0-8.31,2.2A4,4,0,0,0,.5,19.27V20A1.5,1.5,0,0,0,2,21.5H14.43" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </th>
                                        @endif
                                    </tr>
                                </thead>

                                @if ($participants->count() > 0)
                                    <tbody class="text-sm border-b text-neutral-600">
                                        @foreach ($participants as $index => $participant)
                                            <x-participants_table :index="$index + 1" :participant="$participant" :election="$election" />
                                        @endforeach
                                    </tbody>
                                @else
                                    <tr class="text-sm text-center cursor-default text-neutral-500">
                                        <td colspan="4" class="pt-8 pb-3">
                                            No participant for this election.
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
