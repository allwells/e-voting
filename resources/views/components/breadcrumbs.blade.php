@props(['previousPage' => $previousPage, 'currentPage' => $currentPage, 'link' => $link])

<div class="cursor-default text-neutral-700 dark:text-neutral-500 text-xs">
    <a href='{{ route("$link") }}' class="text-indigo-600 cursor-pointer dark:text-indigo-500 underline">
        {{ $previousPage }}
    </a>
    /
    <span class="text-neutral-400 dark:text-neutral-500">{{ $currentPage }}</span>
</div>
