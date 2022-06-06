@props(['election' => $election])

<tr class="bg-white border-b border-neutral-100 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-neutral-900">
    <td class="py-4 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-4 py-4 text-left cursor-default border-neutral-200 line-clamp-1"
        title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="py-4 text-center capitalize cursor-default border-neutral-200">
        <a href="{{ route('results.view', $election->id) }}" type="submit" title="View results for this election"
            class="px-2 font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none hover:underline">
            View
        </a>
    </td>
</tr>
