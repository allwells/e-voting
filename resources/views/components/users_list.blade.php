@props(['user' => $user])

<li
    class="px-4 py-3 my-3 transition duration-300 border rounded-lg shadow-lg bg-neutral-50 border-neutral-200 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-700 dark:bg-neutral-900">
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
            <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile.jpg') }}" alt="Neil image">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium truncate text-neutral-900 dark:text-white">
                {{ $user->name }}
            </p>
            <p class="text-sm truncate text-neutral-500 dark:text-neutral-400">
                {{ $user->email }}
            </p>
        </div>
        <div class="inline-flex items-center text-base font-semibold text-neutral-900 dark:text-white">

            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left-start"
                class="inline-flex items-center p-1 my-1 text-sm font-medium text-center transition duration-300 bg-transparent rounded-full text-neutral-700 focus:outline-none hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
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
                class="z-20 hidden bg-white border divide-y rounded shadow dark:border-neutral-500 border-neutral-300 w-fit divide-neutral-100 dark:bg-neutral-700">
                <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                    aria-labelledby="dropdownLeftButton">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            @if ($user->privilege == 'admin')
                                Remove Admin Privilege
                            @else
                                Make Admin
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</li>
