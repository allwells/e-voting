@props(['election' => $election])

<tr
    class="my-2 leading-loose bg-white dark:bg-neutral-800 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-900">
    <td class="w-8 px-4 py-2 text-center cursor-default">
        {{ $election->id }}
    </td>

    <td class="px-4 py-2 text-left cursor-default" title="{{ $election->title }}">
        {{ $election->title }}
    </td>

    <td class="px-4 py-2 text-left cursor-default line-clamp-1" title="{{ $election->description }}">
        {{ $election->description }}
    </td>

    <td class="px-4 py-2 text-left capitalize cursor-default">
        {{ $election->type }}
    </td>
</tr>
