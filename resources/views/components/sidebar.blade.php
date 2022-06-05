<aside id="mobile-menu-2"
    class="fixed w-72 hidden sm:flex flex-col z-50 h-full px-2 pb-3 pt-0.5 top-0 bg-white shadow-xl dark:bg-neutral-900 text-neutral-700 dark:text-neutral-300"
    aria-label="Sidebar">
    <div class="flex flex-col items-start justify-start w-full h-full px-3 pt-2 sm:justify-between">
        <ul class="w-full space-y-2">
            <li class="flex items-center justify-end py-3 sm:justify-start">
                <x-logo />
            </li>


            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center h-12 p-2 text-base font-normal transition duration-300 dashboard-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Dashboard</span>
                </a>
            </li>


            @if (auth() && auth()->user()->privilege == 'admin')
                <li>
                    <a href="#"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 information-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Candidate Details</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('candidates') }}"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 information-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Add Candidate</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 information-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Register</span>
                    </a>
                </li>
            @endif

            @if (auth() && auth()->user()->privilege == 'user')
                <li>
                    <a href="{{ route('information') }}"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 information-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Information</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('voter.registration') }}"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 registration-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Voter Registration</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('voting') }}"
                        class="flex items-center h-12 p-2 text-base font-normal transition duration-300 voting-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Voting Area</span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('elections') }}"
                    class="flex items-center h-12 p-2 text-base font-normal transition duration-300 information-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Elections</span>
                </a>
            </li>

            <li>
                <a href="{{ route('results') }}"
                    class="flex items-center h-12 p-2 text-base font-normal transition duration-300 result-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Result</span>
                </a>
            </li>
        </ul>

        <span class="w-full">


            <a href="#"
                class="flex items-center h-12 p-2 text-base font-normal transition duration-300 settings-btn hover:bg-neutral-200 dark:hover:bg-neutral-800">
                <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
                <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Settings</span>
            </a>


            <form id="logout-form" class="w-full mt-2" action="{{ route('logout') }}" method="post">
                @csrf

                <button
                    class="flex items-center justify-start w-full h-12 p-2 text-base font-normal transition duration-300 hover:bg-neutral-200 dark:hover:bg-neutral-800"
                    tabindex="-1" type="submit" aria-disabled="true">
                    <span class="flex items-center justify-start w-full" role="menuitem" tabindex="-1"
                        id="user-menu-item-2">

                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm text-left whitespace-nowrap md:text-md">Logout</span>
                    </span>
                </button>
            </form>


            {{-- <div class="py-5 cursor-default">
                <span class="text-base font-semibold text-ellipsis">
                    Allwell Onen
                </span>
                <span class="text-base text-ellipsis">
                    aleenfestus@gmail.com
                </span>
            </div> --}}
        </span>
    </div>
</aside>
