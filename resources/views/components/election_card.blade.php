@props(['election' => $election])

<div class="w-full p-5 transition duration-300 bg-white border rounded-lg border-neutral-200 hover:border-indigo-600">
    <div class="flex items-center justify-between">
        <h1 class="flex items-center text-lg font-medium text-neutral-800">
            {{ $election->title }}
            @if ($election->type == 'private')
                <span class="flex items-center justify-center text-red-600 w-fit h-fit" title="This election is private">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endif
        </h1>
        <span class="text-sm tracking-wide text-neutral-500"> posted
            {{ $election->created_at->diffForHumans() }}</span>
    </div>

    <div class="flex flex-col items-center justify-start gap-2 mt-2 text-xs font-normal sm:flex-row text-neutral-500">
        <span>
            <i class="mr-1 fa fa-clock"></i>{{ substr($election->start_date, 10, 6) }}
            <i
                class="ml-2 mr-1 fa fa-calendar"></i>{{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
        </span>

        <span class="hidden sm:block">-</span>
        <span class="sm:hidden">to</span>

        <span>
            <i class="mr-1 fa fa-clock"></i>{{ substr($election->end_date, 10, 6) }}
            <i
                class="ml-2 mr-1 fa fa-calendar"></i>{{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
        </span>
    </div>

    <p class="mt-4 text-sm font-normal tracking-wide text-neutral-700 line-clamp-1"
        title="{{ $election->description }}">
        {{ $election->description }}
    </p>

    <div class="flex items-center justify-end mt-3">
        <a href="{{ route('elections.show', $election->id) }}"
            class="px-4 py-2 text-sm text-white bg-indigo-600 rounded text-medium hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-300">
            Participate
        </a>
    </div>
</div>
