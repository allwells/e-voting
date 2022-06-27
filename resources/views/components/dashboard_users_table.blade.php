@props(['index' => $index, 'user' => $user])

<tr class="hover:bg-neutral-50">
    <td class="text-center cursor-default w-fit px-3">
        {{ $index }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $user->fname }} {{ $user->lname }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $user->email }}
    </td>

    <td class="px-2 py-3 text-left">
        {{ $user->privilege }}
    </td>

    <td class="text-center capitalize cursor-default">
        <button id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart-{{ $user->id }}"
            data-dropdown-placement="left-start"
            class="p-1 hover:bg-neutral-200 rounded-md focus:bg-neutral-300 focus:text-neutral-900">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                </path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownLeftStart-{{ $user->id }}"
            class="absolute z-10 hidden bg-white divide-y rounded-lg shadow-lg right-4 divide-neutral-100 w-52 dark:bg-neutral-700">
            <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                <li>
                    <form action="{{ route('users.privilege', $user->id) }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="flex items-center justify-start w-full gap-2 p-3 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                            @if ($user->privilege == 'admin')
                                Remove admin privilege
                            @else
                                Make admin
                            @endif
                        </button>
                    </form>
                </li>
                {{-- <li>
                    <form action="{{ route('users.block', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-start text-left w-full gap-2 p-3 transition duration-300 rounded-lg hover:bg-neutral-100 hover:text-neutral-900">
                            Block user
                        </button>
                    </form>
                </li> --}}
                <li>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

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
