@props(['index' => $index, 'election' => $election, 'today' => $today, 'hasDescription' => $hasDescription])

@php
$isStarted = $today->gt($election->start_date) && $today->lt($election->end_date) && $election->status != 'closed';
$isNotStarted = $today->lt($election->start_date) && $today->lt($election->end_date) && $election->status != 'closed';
$isEnded = ($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed';
@endphp

<tr class="text-sm font-normal hover:bg-neutral-50">
    <td class="px-3 text-center cursor-default w-fit">
        {{ $index }}
    </td>

    <td class="py-3 pl-3 text-left">
        {{ $election->title }}
    </td>

    @if ($hasDescription)
        <td class="py-3 pl-3 text-left">
            <div class="w-full max-w-xl line-clamp-1">
                {{ $election->description }}
            </div>
        </td>
    @endif

    <td class="py-3 text-center text-xs uppercase font-semibold">
        @if ($election->type === 'public')
            <span class="text-green-600">{{ $election->type }}</span>
        @elseif ($election->type === 'private')
            <span class="text-red-600">{{ $election->type }}</span>
        @endif
    </td>

    <td class="py-3 text-center text-xs uppercase font-semibold">
        @if ($isNotStarted)
            <span class="text-[#0000FF]">upcoming</span>
        @elseif ($isStarted)
            <span class="text-green-600">started</span>
        @elseif($isEnded)
            <span class="text-red-600">ended</span>
        @endif
    </td>

    <td class="text-center capitalize cursor-default">
        <button id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart-{{ $election->id }}"
            data-dropdown-placement="left-start"
            class="p-1 rounded hover:bg-neutral-200 hover:text-neutral-900 focus:bg-neutral-300 focus:text-neutral-900">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                </path>
            </svg>
        </button>

        <div id="dropdownLeftStart-{{ $election->id }}"
            class="absolute z-10 hidden bg-white rounded-lg shadow-lg right-4 w-44 dark:bg-neutral-700">
            <ul class="flex flex-col gap-1 p-1.5 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                <li>
                    <a href="{{ route('elections.show', $election->id) }}"
                        class="flex items-center justify-start w-full gap-2 px-3 py-2 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                        View
                    </a>
                </li>

                @if ($isNotStarted)
                    <li>
                        <form action="{{ route('elections.edit', $election->id) }}" method="GET">
                            @csrf

                            <button type="submit"
                                class="flex items-center justify-start w-full gap-2 px-3 py-2 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                Edit
                            </button>
                        </form>
                    </li>
                @endif

                @if ($isStarted)
                    <li>
                        <form action="{{ route('elections.close', $election->id) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="flex items-center justify-start w-full gap-2 px-3 py-2 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                                Close
                            </button>
                        </form>
                    </li>
                @endif

                <li>
                    <form action="{{ route('elections.delete', $election->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="flex items-center justify-start w-full gap-2 px-3 py-2 text-left transition duration-300 rounded-lg text-rose-600 hover:bg-neutral-100">
                            Delete
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </td>
</tr>
