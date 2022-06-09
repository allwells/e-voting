@props(['election' => $election, 'today' => $today])

<tr
    class="bg-white border-l border-y border-neutral-200 dark:border-neutral-800/50 hover:bg-neutral-100 dark:hover:bg-neutral-800/30 dark:bg-neutral-900">
    <td class="py-4 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-4 py-4 text-left border-l cursor-default border-neutral-200 dark:border-neutral-800/50"
        title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="px-4 py-4 text-left border-l cursor-default border-neutral-200 dark:border-neutral-800/50">
        @if ($today->lt($election->start_date) && $today->lt($election->end_date))
            <span class="text-xs font-semibold text-blue-600 uppercase">upcoming</span>
        @elseif ($today->gt($election->start_date) && $today->gt($election->end_date))
            <span class="text-xs font-semibold text-red-600 uppercase">ended</span>
        @else
            <span class="text-xs font-semibold text-green-600 uppercase">started</span>
        @endif
    </td>

    <td class="py-4 text-center capitalize cursor-default border-x border-neutral-200 dark:border-neutral-800/50">
        <a href="{{ route('elections.view', $election->id) }}" type="submit" title="Enter Election"
            class="px-4 font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none dark:text-indigo-500 hover:underline">
            Enter
        </a>
    </td>
</tr>
