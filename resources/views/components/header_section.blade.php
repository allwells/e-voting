<div class="flex items-center justify-between ml-4 mb-4">
    <div class="flex justify-end flex-grow gap-4">
        <div class="sm:flex hidden items-center text-sm font-normal gap-2 text-neutral-600 w-fit">
            <span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </span>
            <span>Today is <b>{{ date('l dS') }} of {{ date('F Y') }}
                    {{-- {{ date('h:iA', strtotime(date('h:iA')) + 60 * 60) }} --}}
                </b>
            </span>
        </div>

        <div class="sm:hidden flex w-full items-center justify-center">
            <x-logo />
        </div>

        <div class="md:flex items-center justify-center cursor-default hidden">
            <div class="flex justify-center items-center h-fit w-fit">
                <button type="button" id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart"
                    data-dropdown-placement="left-start"
                    class="flex items-center justify-center text-base font-bold uppercase rounded-full hover:bg-neutral-200 h-10 w-10 text-neutral-500 bg-white">
                    {{ auth()->user()->fname[0] . (auth()->user()->lname ? auth()->user()->lname[0] : null) }}
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownLeftStart"
                    class="absolute z-10 hidden bg-white divide-y rounded-md shadow-lg right-4 divide-neutral-100 w-44 dark:bg-neutral-700">
                    <ul class="flex flex-col gap-1 p-1 text-sm text-neutral-500"
                        aria-labelledby="dropdownLeftStartButton">
                        <li>
                            <a href="{{ route('profile') }}"
                                class="flex items-center justify-start gap-2 p-2 transition duration-300 rounded-md hover:bg-neutral-100 hover:text-neutral-900">
                                <span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
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

    </div>
</div>
