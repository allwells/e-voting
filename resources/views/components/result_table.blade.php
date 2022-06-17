@props(['election' => $election])

<tr
    class="text-sm text-neutral-600 hover:text-neutral-900 transition duration-300 bg-white cursor-default hover:bg-neutral-100/50">
    <td class="py-3 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-2 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="py-3 border-x text-left cursor-default border-neutral-200" title="{{ $election->description }}">
        <div class="pl-2 line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="py-3 text-center capitalize cursor-default border-neutral-200">
        <a href="{{ route('results.view', $election->id) }}" type="submit" title="View results for this election"
            class="font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none dark:text-indigo-500 hover:underline">
            View
        </a>
    </td>
</tr>
