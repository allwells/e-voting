<div
    class="flex items-center w-full border justify-between md:justify-center gap-3 p-1.5 cursor-default rounded-md bg-white overflow-y-hidden">
    <div class="flex justify-start items-center gap-2">
        <a href="{{ route('profile') }}">
            <div
                class="flex items-center justify-center text-lg font-bold uppercase rounded hover:bg-neutral-200 h-9 w-9 text-neutral-500 bg-neutral-200/50">
                {{ auth()->user()->fname[0] . (auth()->user()->lname ? auth()->user()->lname[0] : null) }}
            </div>
        </a>

        <div class="flex flex-col items-start justify-start text-sm font-medium text-neutral-700">
            <a href="{{ route('profile') }}" class="hover:underline">
                <span>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</span>
            </a>
            <span class="text-xs font-normal text-neutral-500">{{ auth()->user()->email }}</span>
        </div>
    </div>

    <div class="flex justify-center items-center h-fit w-fit">
        <button type="button" id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart"
            data-dropdown-placement="left-start"
            class="p-0.5 border-none rounded outline-none hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                </path>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownLeftStart"
            class="absolute z-10 hidden bg-white divide-y rounded-md shadow-lg right-4 divide-neutral-100 w-44 dark:bg-neutral-700">
            <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500" aria-labelledby="dropdownLeftStartButton">
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center justify-start gap-2 p-2 transition duration-300 rounded-md hover:bg-neutral-100 hover:text-neutral-900">
                        <span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </span>
                        <span>Profile</span>
                    </a>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-start w-full gap-2 p-2 transition duration-300 rounded-md hover:bg-neutral-100 hover:text-neutral-900">
                            <span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
