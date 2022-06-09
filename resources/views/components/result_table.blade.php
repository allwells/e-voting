@props(['election' => $election])

<tr
    class="bg-white border-b border-neutral-100 dark:border-neutral-800/50 hover:bg-neutral-100 dark:hover:bg-neutral-800/30 dark:bg-neutral-900">
    <td class="py-4 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="pl-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="py-4 text-left cursor-default border-neutral-200 line-clamp-1" title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="py-4 text-center capitalize cursor-default border-neutral-200">
        <a href="{{ route('results.view', $election->id) }}" type="submit" title="View results for this election"
            class="pr-2 font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none dark:text-indigo-500 hover:underline">
            View
        </a>
    </td>
</tr>
