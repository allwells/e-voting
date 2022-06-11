@props(['candidate' => $candidate, 'votes' => $votes])

<tr
    class="my-2 text-sm leading-loose bg-white cursor-default dark:text-neutral-200 dark:bg-neutral-900 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-900/80">
    <td class="w-8 px-4 py-3 text-center">
        {{ $candidate->id }}
    </td>

    <td class="px-4 py-3 text-left">
        {{ $candidate->name }}
    </td>

    <td class="px-4 py-3 text-left">
        {{ $candidate->party }}
    </td>

    <td class="px-4 py-3 text-center">
        {{ $votes->where('candidate_id', $candidate->id)->count() }}
    </td>
</tr>
