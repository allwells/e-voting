@props(['election' => $election])

<div
    class="flex-grow p-5 transition duration-300 bg-white border rounded-lg border-neutral-200 hover:border-indigo-600 max-w-lg w-96">
    <div class="flex justify-start items-start sm:items-center sm:justify-between flex-col sm:flex-row">
        <h1 class="flex items-center text-lg font-medium text-neutral-800 gap-1">
            {{ $election->title }}
            @if ($election->type == 'private')
                <span
                    class="flex items-center justify-center bg-red-600 rounded-sm px-0.5 w-fit h-fit font-normal text-xs uppercase text-white"
                    title="This election is private">
                    private
                </span>
            @endif
        </h1>
        <span class="text-sm tracking-wide text-neutral-500"> posted
            {{ $election->created_at->diffForHumans() }}</span>
    </div>

    <div
        class="flex flex-col sm:items-center items-start sm:justify-start gap-2 mt-1 text-xs font-normal sm:flex-row text-neutral-500">
        <span class="flex justify-start items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ substr($election->start_date, 10, 6) }}

            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
        </span>

        <span class="hidden sm:block">-</span>
        <span class="sm:hidden">to</span>

        <span class="flex justify-start items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ substr($election->end_date, 10, 6) }}

            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
        </span>
    </div>

    <p class="mt-2 text-sm font-normal tracking-wide text-neutral-700 line-clamp-1"
        title="{{ $election->description }}">
        {{ $election->description }}
    </p>

    <div class="flex items-center justify-end mt-3">
        <a href="{{ route('elections.show', $election->id) }}"
            class="px-2 py-2 sm:py-1 text-sm text-white bg-indigo-600 rounded w-full sm:w-fit text-center text-normal hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40 capitalize">
            View Election
        </a>
    </div>
</div>
