@props(['edit_href' => $edit_href, 'close_href' => $close_href, 'delete_href' => $delete_href, 'view_election' => $view_election, 'title' => $title, 'description' => $description])


<div
    class="w-full sm:w-4/5 flex flex-col items-center bg-neutral-50 rounded-lg border shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
    <div class="pt-2 px-2 z-20 w-full flex justify-end items-center">
        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left-start"
                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
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
                class="z-30 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-fit divide-neutral-100 rounded shadow dark:bg-neutral-700">
                <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                    aria-labelledby="dropdownLeftButton">
                    <li>
                        <a href="{{ $edit_href }}"
                            class="transition duration-300 block px-4 py-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            Edit
                        </a>
                    </li>
                    <li>
                        <a href="{{ $close_href }}"
                            class="transition duration-300 block px-4 py-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            Close Election
                        </a>
                    </li>
                    <li>
                        <a href="{{ $delete_href }}"
                            class="transition duration-300 block px-4 py-2 font-medium rounded-md text-red-500 hover:bg-red-100 dark:hover:text-red-300 dark:hover:bg-red-700">
                            Delete
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>

    <div class="-mt-7 flex flex-col justify-between items-start px-4 sm:px-6 leading-normal w-full">
        {{-- Election title --}}
        <h5 class="mb-2 text-lg sm:text-2xl font-bold text-neutral-900 dark:text-white">
            {{ $title }}
        </h5>

        {{-- Election description --}}
        <p class="mb-3 text-left font-normal text-neutral-700 dark:text-neutral-400">
            {{ $description }}
        </p>
    </div>

    <div class="w-full flex flex-col sm:flex-row justify-end items-center gap-3 px-4 sm:px-6 py-6">
        <a href="{{ $view_election }}"
            class="text-white px-6 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
            View
            <svg class="w-5 h-5 ml-1 pt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </a>
    </div>
</div>
