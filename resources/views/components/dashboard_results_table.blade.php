@props(['index' => $index, 'result' => $result, 'hasDescription' => $hasDescription])

@php
$votes = App\Models\Vote::where('election_id', $result->id)->get();
$candidates = App\Models\Candidate::where('election_id', $result->id)->get();
@endphp

<tr class="hover:bg-neutral-50 text-xs">
    <td class="text-center cursor-default w-fit px-3">
        {{ $index }}
    </td>

    <td class="px-2 py-2 text-left">
        {{ $result->title }}
    </td>

    @if ($hasDescription)
        <td class="px-2 py-2 text-left">
            <div class="line-clamp-1 max-w-5xl w-full">
                {{ $result->description }}
            </div>
        </td>
    @endif

    <td class="px-2 py-2 text-center">
        {{ $candidates->count() }}
    </td>

    <td class="px-2 py-2 text-center">
        {{ $votes->count() }}
    </td>

    <td class="px-2 py-2 text-left">
        <div class="text-[#0000FF] flex justify-center items-center">
            <a href="{{ route('results.view', $result) }}" title="View Results"
                class="hover:bg-neutral-800/10 rounded-md p-1 focus:bg-neutral-800/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </td>
</tr>
