@props(['election' => $election])

<a href="{{ route('elections.show', $election->id) }}"
    class="w-full p-5 transition duration-300 bg-white border rounded-lg border-neutral-200 hover:border-indigo-600">
    <div class="flex items-center justify-between">
        <h1 class="text-lg font-medium text-neutral-800">
            {{ $election->title }}
        </h1>
        <span class="text-sm tracking-wide text-neutral-500"> posted
            {{ $election->created_at->diffForHumans() }}</span>
    </div>

    <div class="flex flex-col items-center justify-start gap-2 mt-2 text-xs font-normal sm:flex-row text-neutral-500">
        <span>
            <i class="mr-1 fa fa-clock"></i>{{ substr($election->start_date, 10, 6) }}UTC
            <i
                class="ml-2 mr-1 fa fa-calendar"></i>{{ date('d F, Y', strtotime(str_replace('-', '', substr($election->start_date, 0, 10)))) }}
        </span>

        <span class="hidden sm:block">-</span>
        <span class="sm:hidden">to</span>

        <span>
            <i class="mr-1 fa fa-clock"></i>{{ substr($election->end_date, 10, 6) }}UTC
            <i
                class="ml-2 mr-1 fa fa-calendar"></i>{{ date('d F, Y', strtotime(str_replace('-', '', substr($election->end_date, 0, 10)))) }}
        </span>
    </div>

    <p class="mt-4 text-sm font-normal tracking-wide text-neutral-700 line-clamp-1"
        title="{{ $election->description }}">
        {{ $election->description }}
    </p>
</a>
