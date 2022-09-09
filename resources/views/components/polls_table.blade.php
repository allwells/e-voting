@props(['index' => $index, 'poll' => $poll, 'today' => $today])

@php
$totalResponses = \App\Models\Response::where('poll_id', $poll->id)
    ->get()
    ->count();

// $isStarted = $today->gt($poll->start_date) && $today->lt($poll->end_date);
// $isNotStarted = $today->lt($poll->start_date) && $today->lt($poll->end_date);
// $isEnded = ($today->gt($poll->start_date) && $today->gt($poll->end_date));

@endphp

<tr class="hover:bg-neutral-50">
    <td class="text-center cursor-default w-fit px-3">
        {{ $index }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $poll->title }}
    </td>

    <td class="px-2 py-3 text-center">
        {{ $totalResponses }}
    </td>

    <td class="text-center capitalize cursor-default">
        <button id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart-{{ $poll->id }}"
            data-dropdown-placement="left-start"
            class="p-1 hover:bg-neutral-200 rounded focus:bg-neutral-300 focus:text-neutral-900">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                </path>
            </svg>
        </button>

        <div id="dropdownLeftStart-{{ $poll->id }}"
            class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-52 dark:bg-neutral-700">
            <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                <li>
                    <a href="{{ route('polls.show', $poll->id) }}"
                        class="flex items-center justify-start w-full gap-2 p-3 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                        View
                    </a>
                </li>
                <li>
                    <form action="{{ route('polls.destroy', $poll) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <button type="submit"
                            class="flex items-center justify-start text-left w-full gap-2 p-3 transition duration-300 rounded-lg text-rose-600 hover:bg-neutral-100">
                            Delete
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </td>
</tr>
