@props(['index' => $index, 'result' => $result, 'hasDescription' => $hasDescription, 'hasPrivacy' => $hasPrivacy])

@php
$votes = App\Models\Vote::where('election_id', $result->id)->get();
$candidates = App\Models\Candidate::where('election_id', $result->id)->get();
@endphp

<tr class="text-sm font-normal hover:bg-neutral-50">
    <td class="px-3 text-center cursor-default w-fit">
        {{ $index }}
    </td>

    <td class="px-2 py-2 text-left">
        {{ $result->title }}
    </td>

    @if ($hasDescription)
        <td class="px-2 py-2 text-left">
            <div class="w-full max-w-5xl line-clamp-1">
                {{ $result->description }}
            </div>
        </td>
    @endif

    @if ($hasPrivacy)
        <td class="py-3 text-center text-[10px] uppercase font-bold">
            <span class="{{ $result->type === 'public' ? 'text-green-600' : 'text-red-600' }}">{{ $result->type }}</span>
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
                class="p-1 rounded-md hover:bg-neutral-800/10 focus:bg-neutral-800/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </td>
</tr>
