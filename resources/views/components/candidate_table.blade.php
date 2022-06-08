@props(['candidate' => $candidate, 'votes' => $votes])

<tr
    class="my-2 leading-loose bg-white dark:text-neutral-200 dark:bg-neutral-900 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-900/80">
    <td class="w-8 px-4 py-2 text-center cursor-default">
        {{ $candidate->id }}
    </td>

    <td class="px-4 py-2 text-left cursor-default">
        {{ $candidate->name }}
    </td>

    <td class="px-4 py-2 text-left cursor-default">
        {{ $candidate->party }}
    </td>

    <td class="px-4 py-2 text-left cursor-default">
        {{ $votes->where('candidate_id', $candidate->id)->count() }}
    </td>
</tr>
