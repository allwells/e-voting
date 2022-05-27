<!-- This example requires Tailwind CSS v2.0+ -->
<nav
    class="z-40 border-b shadow-lg border-neutral-300 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm dark:border-neutral-700">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm rounded-lg text-neutral-500 md:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-600"
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
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-start text-3xl font-bold text-center w-fit">
                        <span class="-mr-1 text-indigo-600">e</span>
                        <span class="text-neutral-800 dark:text-neutral-200">Voting</span>
                    </a>
                </div>

                {{-- nav items --}}
                {{-- <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center justify-center px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">
                            <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('elections') }}"
                            class="flex items-center justify-center px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                            aria-current="page">

                            <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                            Elections
                        </a>

                        @if (auth()->user()->privilege == 'superuser')
                            <a href="{{ route('users') }}"
                                class="flex items-center justify-center px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:active:ring-2 dark:active:ring-neutral-700 dark:hover:bg-neutral-800 hover:bg-neutral-100 active:ring-2 active:ring-neutral-200 ring-offset-2 ring-offset-white dark:ring-offset-neutral-900"
                                aria-current="page">

                                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Users
                            </a>
                        @endif
                    </div>
                </div> --}}
            </div>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                {{-- Uncomment this if notification feature is implemented --}}

                {{-- Notification button --}}
                {{-- <button type="button"
                    class="p-1 rounded-full text-neutral-400 bg-neutral-800 hover:text-neutral-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:ring-neutral-600">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="w-6 h-6 transition duration-300 text-neutral-300 dark:text-neutral-500 dark:hover:text-neutral-50"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button> --}}

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button" id="dropdownLeftStartButton" data-dropdown-toggle="dropdownLeftStart"
                            class="flex rounded-full text-neutral-400 ring-1 dark:ring-0 ring-neutral-600 bg-neutral-800 focus:outline-none focus:ring-2 dark:focus:ring-2 dark:focus:ring-offset-2 dark:focus:ring-offset-neutral-900"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">

                            <span class="sr-only">Open user menu</span>

                            <div id="nav-profile-image"
                                style="background-image: url('{{ asset('images/profile.jpg') }}');"
                                class="relative w-10 h-10 rounded-full"></div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownLeftStart"
                            class="absolute hidden py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-neutral-800 ring-1 ring-neutral-800 dark:ring-neutral-700 ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="dropdownDefault" tabindex="-1">

                            <div class="px-4 py-3 mb-1 border-b dark:border-neutral-700">
                                <span
                                    class="block text-sm font-semibold cursor-default text-neutral-800 dark:text-neutral-200">{{ auth()->user()->name }}</span>
                                <span
                                    class="block text-sm font-medium truncate cursor-default text-neutral-500 dark:text-neutral-400">
                                    {{ auth()->user()->email }}
                                </span>
                            </div>

                            <a href="{{ route('dashboard') }}"
                                class="flex items-center justify-start px-4 py-2 mx-1 text-sm align-middle transition duration-300 rounded-md dark:hover:bg-neutral-700 dark:text-neutral-100 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">

                                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>

                                Dashboard
                            </a>

                            <a href="{{ route('profile') }}"
                                class="flex items-center justify-start px-4 py-2 mx-1 mt-1 text-sm align-middle transition duration-300 rounded-md dark:hover:bg-neutral-700 dark:text-neutral-100 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">

                                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Profile
                            </a>

                            <a href="{{ route('settings') }}"
                                class="flex items-center justify-start px-4 py-2 mx-1 mt-1 text-sm align-middle transition duration-300 rounded-md dark:hover:bg-neutral-700 dark:text-neutral-100 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900"
                                role="menuitem" tabindex="-1" id="user-menu-item-1">

                                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                    </path>
                                </svg>
                                Settings
                            </a>

                            <div class="w-full mt-1 border-b border-neutral-200 dark:border-neutral-700"></div>

                            <a href="{{ route('logout') }}"
                                class="flex items-center justify-start px-4 py-2 mx-1 mt-1 text-sm align-middle transition duration-300 rounded-md dark:hover:bg-neutral-700 dark:text-neutral-100 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 active:bg-neutral-200 dark:active:bg-neutral-900"
                                role="menuitem" tabindex="-1" id="user-menu-item-2">

                                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
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
        <div class="px-2 pt-1 pb-1 space-y-1">

            <div class="w-full mt-1 border-b border-neutral-200 dark:border-neutral-800"></div>

            <a href="{{ route('dashboard') }}"
                class="flex items-center justify-start px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 hover:bg-neutral-100"
                aria-current="page">
                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Dashboard
            </a>

            <div class="w-full mt-1 border-b border-neutral-200 dark:border-neutral-800"></div>

            <a href="{{ route('elections') }}"
                class="flex items-center justify-start px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 hover:bg-neutral-100"
                aria-current="page">

                <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
                Elections
            </a>

            @if (auth()->user()->privilege == 'superuser')
                <div class="w-full mt-1 border-b border-neutral-200 dark:border-neutral-800"></div>

                <a href="{{ route('users') }}"
                    class="flex items-center justify-start px-3 py-2 text-sm font-medium transition duration-300 rounded-md text-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 hover:bg-neutral-100"
                    aria-current="page">

                    <svg class="flex-shrink-0 w-6 h-6 mr-2 transition duration-300 text-neutral-500 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Users
                </a>
            @endif
        </div>
    </div>
</nav>
