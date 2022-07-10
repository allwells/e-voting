@props(['index' => $index, 'election' => $election])

<tr class="hover:bg-neutral-50">
    <td class="text-center cursor-default w-14">
        {{ $index }}
    </td>

    <td class="py-3 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-3 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-3 py-4 text-left cursor-default" title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="px-3 text-center">
        <a href="{{ route('results.view', $election->id) }}" type="submit" title="Show result for this election"
            class="bg-indigo-600 hover:bg-indigo-700 focus:ring focus:ring-indigo-600/40 rounded p-1 text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </a>
    </td>
</tr>
