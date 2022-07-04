@props(['index' => $index, 'election' => $election, 'today' => $today])

<tr class="hover:bg-neutral-50">
    <td class="text-center cursor-default w-fit px-3">
        {{ $index }}
    </td>

    <td class="py-3 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-4 py-3 text-left cursor-default" title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="px-4 py-3 text-left cursor-default text-xs font-normal lowercase">
        @if ($election->type == 'private')
            <span class="text-white bg-rose-600 p-1 rounded">private</span>
        @else
            <span class="text-white bg-emerald-600 p-1 rounded">public</span>
        @endif
    </td>

    <td class="px-4 py-3 text-left cursor-default text-xs font-semibold uppercase">
        @if ($today->lt($election->start_date) && $today->lt($election->end_date) && !($election->status == 'closed'))
            <span class="text-blue-600">upcoming</span>
        @elseif (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
            <span class="text-rose-600">ended</span>
        @else
            <span class="text-emerald-600">started</span>
        @endif
    </td>

    <td class="text-center capitalize cursor-default">
        @if (auth() && (auth()->user()->privilege != 'superuser' && auth()->user()->privilege != 'admin'))
            <a href="{{ route('elections.show', $election->id) }}" type="submit" title="Enter election"
                class="hover:bg-neutral-300/50 rounded p-1 text-neutral-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        @else
            <button id="dropdownLeftButton-{{ $election->id }}"
                data-dropdown-toggle="dropdownLeft-{{ $election->id }}" data-dropdown-placement="left-start"
                class="inline-flex items-center p-1 text-sm font-medium text-center transition duration-300 bg-transparent rounded text-neutral-700 focus:outline-none hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:ring-neutral-500"
                type="button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                    </path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownLeft-{{ $election->id }}"
                class="z-20 hidden w-40 bg-white border divide-y rounded shadow dark:border-neutral-700 border-neutral-300 divide-neutral-100 dark:bg-neutral-800">
                <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                    aria-labelledby="dropdownLeftButton-{{ $election->id }}">
                    <li>
                        <a href="{{ route('elections.show', $election->id) }}" title="View election"
                            class="block px-4 py-2 font-normal rounded hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                            Enter
                        </a>
                    </li>

                    @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                        <div class="my-1"></div>

                        <li>
                            <a href="{{ route('elections.edit', $election->id) }}" title="Edit this election"
                                class="block px-4 py-2 font-normal rounded hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                                Edit
                            </a>
                        </li>
                    @endif

                    @if ($today->gt($election->start_date) && $today->lt($election->end_date) && !($election->status == 'closed'))
                        <div class="my-1"></div>

                        <li>
                            <form action="{{ route('elections.close', $election->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                <button type="submit" title="Close this election"
                                    class="block w-full px-4 py-2 font-normal text-left rounded hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                                    Close
                                </button>
                            </form>
                        </li>
                    @endif

                    <div class="my-1 border-b dark:border-neutral-700 border-neutral-100"></div>

                    <li>
                        <form action="{{ route('elections.delete', $election->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="Delete this election"
                                class="block w-full px-4 py-2 font-medium text-left rounded text-rose-600 hover:bg-neutral-100 dark:text-rose-600 dark:hover:bg-neutral-700/50">
                                Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </td>
</tr>
