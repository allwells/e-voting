@props(['user' => $user])


<tr class="my-2 bg-white dark:bg-neutral-800 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-900">
    <td class="px-4 py-2">
        {{ $user->id }}
    </td>
    <td class="px-4 py-2">
        {{ $user->name }}
    </td>
    <td class="px-4 py-2">
        {{ $user->email }}
    </td>
    <td class="px-4 py-2">
        {{ $user->privilege }}
    </td>
    <td class="text-center">
        <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left-start"
            class="inline-flex items-center p-1 my-1 text-sm font-medium text-center transition duration-300 bg-transparent rounded-full text-neutral-700 focus:outline-none hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-500"
            type="button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                </path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownLeft"
            class="z-20 hidden bg-white divide-y rounded shadow w-fit divide-neutral-100 dark:bg-neutral-700">
            <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                aria-labelledby="dropdownLeftButton">
                <li>
                    <a href="#"
                        class="block px-4 py-2 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                        View Profile
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                        @if ($user->privilege == 'admin')
                            Remove Admin Privilege
                        @endif

                        @if ($user->privilege != 'admin')
                            Make Admin
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>
