@props(['election' => $election, 'today' => $today])

<tr
    class="bg-white border-l border-y border-neutral-200 dark:border-neutral-800/50 hover:bg-neutral-100 dark:hover:bg-neutral-800/30 dark:bg-neutral-900">
    <td class="py-3 text-left cursor-default w-fit" title="{{ $election->title }}">
        <div class="px-4 line-clamp-1">{{ $election->title }}</div>
    </td>

    <td class="px-4 py-3 text-left border-l cursor-default border-neutral-200 dark:border-neutral-800/50"
        title="{{ $election->description }}">
        <div class="line-clamp-1">{{ $election->description }}</div>
    </td>

    <td class="px-4 py-3 text-left border-l cursor-default border-neutral-200 dark:border-neutral-800/50">
        @if ($today->lt($election->start_date) && $today->lt($election->end_date))
            <span class="text-xs font-semibold text-blue-600 uppercase">upcoming</span>
        @elseif ($today->gt($election->start_date) && $today->gt($election->end_date))
            <span class="text-xs font-semibold text-red-600 uppercase">ended</span>
        @else
            <span class="text-xs font-semibold text-green-600 uppercase">started</span>
        @endif
    </td>

    <td class="py-3 text-center capitalize cursor-default border-x border-neutral-200 dark:border-neutral-800/50">
        @if (auth() && auth()->user()->privilege == 'admin')
            <button id="dropdownLeftButton-{{ $election->id }}"
                data-dropdown-toggle="dropdownLeft-{{ $election->id }}" data-dropdown-placement="left-start"
                class="inline-flex items-center p-1 text-sm font-medium text-center transition duration-300 bg-transparent text-neutral-700 focus:outline-none hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:ring-neutral-500"
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
                class="z-20 hidden w-40 bg-white border divide-y shadow dark:border-neutral-700 border-neutral-300 divide-neutral-100 dark:bg-neutral-800">
                <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                    aria-labelledby="dropdownLeftButton-{{ $election->id }}">
                    <li>
                        <a href="{{ route('elections.view', $election->id) }}" title="Enter Election"
                            class="block px-4 py-2 font-medium hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                            Enter
                        </a>
                    </li>

                    @if ($today->lt($election->start_date) && $today->lt($election->end_date))
                        <div class="my-1"></div>

                        <li>
                            <form action="{{ route('elections.edit', $election->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                <button type="submit" title="Edit this election"
                                    class="block w-full px-4 py-2 font-medium text-left hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                                    Edit
                                </button>
                            </form>
                        </li>
                    @endif


                    @if ($today->gt($election->start_date) && $today->lt($election->end_date))
                        <div class="my-1"></div>

                        <li>
                            <form action="{{ route('elections.close', $election->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                <button type="submit" title="Close this election"
                                    class="block w-full px-4 py-2 font-medium text-left hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
                                    Close
                                </button>
                            </form>
                        </li>
                    @endif

                    <div class="my-1 border-b dark:border-neutral-700 border-neutral-100"></div>

                    <li>
                        <form action="{{ route('elections.delete', $election->id) }}" method="POST"
                            class="w-full">
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="Delete this election"
                                class="block w-full px-4 py-2 font-medium text-left hover:bg-neutral-100 dark:text-rose-600 dark:hover:bg-neutral-700/50">
                                Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('elections.view', $election->id) }}" title="Enter Election"
                class="px-4 font-semibold text-indigo-600 capitalize bg-transparent border-0 outline-none dark:text-indigo-500 hover:underline">
                Enter
            </a>
        @endif
    </td>
</tr>
