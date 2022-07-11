@props(['index' => $index, 'participant' => $participant, 'election' => $election])

<tr class="hover:bg-neutral-50">
    <td class="w-12 px-3 text-center cursor-default">
        {{ $index }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $participant->name }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $participant->email }}
    </td>

    @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
        <td class="text-center capitalize cursor-default w-14">
            <button id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart-{{ $participant->id }}"
                data-dropdown-placement="left-start"
                class="p-1 rounded hover:bg-neutral-200 focus:bg-neutral-300 focus:text-neutral-900">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                    </path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownLeftStart-{{ $participant->id }}"
                class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-52 dark:bg-neutral-700">
                <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                    <li>
                        <form action="{{ route('participant.destroy', [$election, $participant]) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button type="submit"
                                class="flex items-center justify-start w-full gap-2 p-3 text-left transition duration-300 rounded-lg text-rose-600 hover:bg-neutral-100">
                                Kick out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </td>
    @endif
</tr>
