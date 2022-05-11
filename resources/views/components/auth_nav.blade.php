<!-- This example requires Tailwind CSS v2.0+ -->
<nav id="navbar-container" class="bg-white dark:bg-neutral-900 border-b shadow-lg dark:border-neutral-700">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-neutral-500 rounded-lg md:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                {{-- logo --}}
                <div class="flex items-center flex-shrink-0">
                    <span style="cursor: default;" class="-mt-1 text-3xl font-bold text-indigo-600 ">
                        <span class="-mr-1 text-indigo-600">e</span>
                        <span class="text-neutral-900 dark:text-neutral-100">Voting</span>
                    </span>
                </div>

                {{-- nav items --}}
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 transition duration-300 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 rounded-md hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">Dashboard</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 transition duration-300 dark:text-neutral-300 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 rounded-md hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">Register for election</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 transition duration-300 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 rounded-md hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">Elections</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-sm font-medium text-neutral-700 transition duration-300 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 rounded-md hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">Something</a>
                    </div>
                </div>
            </div>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                {{-- Uncomment this if notification feature is implemented --}}

                {{-- Notification button --}}
                {{-- <button type="button"
                    class="p-1 text-neutral-400 bg-neutral-800 rounded-full hover:text-neutral-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-neutral-600">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="w-6 h-6 text-neutral-300 transition duration-300 dark:text-neutral-500 dark:hover:text-neutral-50"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button> --}}

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button" id="dropdownBottomButton" data-dropdown-toggle="dropdownBottom"
                            class="flex text-neutral-400 bg-neutral-800 rounded-full hover:text-neutral-500 dark:hover:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-neutral-600"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="relative w-10 h-10 overflow-hidden rounded-full">
                                <svg class="absolute w-12 h-12 text-neutral-300 transition duration-300 dark:text-neutral-500 dark:hover:text-neutral-50 -left-1"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownBottom"
                            class="absolute hidden py-1 mt-2 origin-top-right bg-white dark:bg-neutral-800 rounded-md shadow-lg ring-1 ring-neutral-800 dark:ring-neutral-700 ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="dropdownDefault" tabindex="-1">

                            <div class="py-3 px-4 border-b mb-1 dark:border-neutral-700">
                                <span
                                    class="block text-sm cursor-default font-semibold text-neutral-800 dark:text-neutral-200">{{ auth()->user()->name }}</span>
                                <span
                                    class="block text-sm cursor-default font-medium text-neutral-500 truncate dark:text-neutral-400">
                                    {{ auth()->user()->email }}
                                </span>
                            </div>

                            <a href="{{ route('dashboard') }}"
                                class="flex justify-start items-center align-middle px-4 py-2 dark:hover:bg-neutral-700 dark:text-neutral-100 mx-1 text-sm text-neutral-600 rounded-md hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900 transition duration-300"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">
                                <svg class="flex-shrink-0 w-6 h-6 text-neutral-500 transition duration-300 mr-2 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>

                                Dashboard
                            </a>

                            <a href="{{ route('profile') }}"
                                class="flex justify-start items-center align-middle px-4 py-2 dark:hover:bg-neutral-700 dark:text-neutral-100 mx-1 mt-1 text-sm text-neutral-600 rounded-md hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900 transition duration-300"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">
                                Your Profile
                            </a>

                            <a href="{{ route('settings') }}"
                                class="flex justify-start items-center align-middle px-4 py-2 dark:hover:bg-neutral-700 dark:text-neutral-100 mx-1 mt-1 text-sm text-neutral-600 rounded-md hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900 transition duration-300"
                                role="menuitem" tabindex="-1" id="user-menu-item-1">
                                Settings
                            </a>

                            <a href="{{ route('logout') }}"
                                class="flex justify-start items-center align-middle px-4 py-2 dark:hover:bg-neutral-700 dark:text-neutral-100 mx-1 mt-1 text-sm text-neutral-600 rounded-md hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900 transition duration-300"
                                role="menuitem" tabindex="-1" id="user-menu-item-2">
                                Log out
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden" id="mobile-menu-2">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 text-base font-medium text-neutral-700 rounded-md hover:bg-neutral-300 active:bg-neutral-400"
                aria-current="page">Dashboard</a>
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 text-base font-medium text-neutral-700 rounded-md hover:bg-neutral-300 active:bg-neutral-400"
                aria-current="page">Register for election</a>
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 text-base font-medium text-neutral-700 rounded-md hover:bg-neutral-300 active:bg-neutral-400"
                aria-current="page">Election</a>
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 text-base font-medium text-neutral-700 rounded-md hover:bg-neutral-300 active:bg-neutral-400"
                aria-current="page">Something</a>
        </div>
    </div>
</nav>
