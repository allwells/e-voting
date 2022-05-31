<aside
    class="fixed w-56 hidden sm:flex flex-col z-50 border-t h-modal px-2 pb-10 pt-0.5 border-r border-neutral-300 dark:border-neutral-700 top-16 bg-white/50 shadow-xl dark:bg-neutral-900/50"
    aria-label="Sidebar">
    <div class="flex flex-col items-start justify-between w-full h-full px-3 pt-2">
        <ul class="w-full space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-base font-normal transition duration-300 rounded dashboard-btn text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Dashboard</span>
                </a>
            </li>

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>

            <li>
                <a href="{{ route('profile') }}"
                    class="flex items-center p-2 text-base font-normal transition duration-300 rounded profile-btn text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Profile</span>
                </a>
            </li>

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>

            <li>
                <a href="{{ route('elections') }}"
                    class="flex items-center p-2 text-base font-normal transition duration-300 rounded elections-btn text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800">
                    <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Election</span>
                </a>
            </li>

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>

            @if (auth() && auth()->user()->privilege == 'superuser')
                <li>
                    <a href="{{ route('users') }}"
                        class="flex items-center p-2 text-base font-normal transition duration-300 rounded users-btn text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800">
                        <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Users</span>
                    </a>
                </li>

                <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>
            @endif

        </ul>

        <span class="w-full">

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>

            <a href="{{ route('settings') }}"
                class="flex items-center p-2 text-base font-normal transition duration-300 rounded settings-btn text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800">
                <svg class="flex-shrink-0 w-6 h-6 transition duration-75 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                    </path>
                </svg>
                <span class="flex-1 ml-3 text-sm whitespace-nowrap md:text-md">Settings</span>
            </a>

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>

            <form id="logout-form" class="w-full" action="{{ route('logout') }}" method="post">
                @csrf
                <button class="w-full" tabindex="-1" type="submit" aria-disabled="true">
                    <span
                        class="flex items-center justify-start w-full p-2 text-base font-normal transition duration-300 rounded text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-800"
                        role="menuitem" tabindex="-1" id="user-menu-item-2">

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

            <div class="w-full my-2 border-b border-neutral-200 dark:border-neutral-800"></div>
        </span>
    </div>
</aside>
