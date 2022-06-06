@props(['election' => $election])

<tr
    class="border-l dark:bg-neutral-800 border-y border-neutral-200 dark:border-neutral-700 bg-neutral-50 hover:bg-neutral-100 dark:hover:bg-neutral-900">
    <td class="py-4 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-4 py-4 text-left border-l cursor-default border-neutral-200 line-clamp-1"
        title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="py-4 text-left capitalize cursor-default border-x border-neutral-200">
        <a href="{{ route('elections.view', $election->id) }}" type="submit" title="Enter Election"
            class="px-4 font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none hover:underline">
            Enter
        </a>
    </td>
</tr>
