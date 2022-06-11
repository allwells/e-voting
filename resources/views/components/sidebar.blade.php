<aside
    class="sidebar-menu fixed w-72 hidden sm:flex flex-col z-50 h-full px-2 pb-3 pt-0.5 top-0 bg-white shadow-2xl dark:border-r dark:border-neutral-700 dark:bg-neutral-900 text-neutral-700 dark:text-neutral-300"
    aria-label="Sidebar">
    <div class="flex flex-col items-start justify-start w-full h-full px-3 pt-2 sm:justify-between">
        <ul class="w-full space-y-2">
            <li class="flex items-center justify-end px-4 py-1 sm:py-3 sm:justify-start">
                <x-logo />
            </li>


            <li>
                <a href="{{ route('dashboard') }}" id="@yield('dashboard-tab')"
                    class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 dashboard-btn">
                    <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap">Dashboard</span>
                </a>
            </li>


            @if (auth() && auth()->user()->privilege == 'admin')
                <li>
                    <a href="{{ route('candidates') }}" id="@yield('candidate-tab')"
                        class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 information-btn">
                        <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap">Candidates</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="#" id="@yield('register-tab')"
                        class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 register-btn">
                        <svg class="flex-shrink-0 w-6 h-6 text-indigo-600 transition duration-75" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap">Register</span>
                    </a> --}}
                </li>
            @endif

            @if (auth() && auth()->user()->privilege == 'user')
                <li>
                    <a href="{{ route('information') }}" id="@yield('information-tab')"
                        class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 information-btn">
                        <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap">Information</span>
                    </a>
                </li>


                {{-- <li>
                    <a href="{{ route('voter.registration') }}" id="@yield('voter-reg-tab')"
                    <svg
                        class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 registration-btn">
                        <svg class="flex-shrink-0 w-6 h-6 text-indigo-600 transition duration-75" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm whitespace-nowrap">Voter Registration</span>
                    </a>
                </li> --}}
            @endif

            <li>
                <a href="{{ route('elections') }}" id="@yield('election-tab')"
                    class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 election-btn">
                    <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap">Elections</span>
                </a>
            </li>

            <li>
                <a href="{{ route('results') }}" id="@yield('results-tab')"
                    class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 result-btn">
                    <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-sm whitespace-nowrap">Results</span>
                </a>
            </li>
        </ul>

        <span class="w-full">
            <a href="{{ route('settings') }}" id="@yield('settings-tab')"
                class="flex items-center px-3 py-2 text-sm font-normal transition duration-300 rounded-md h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200 settings-btn">
                <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
                <span class="flex-1 ml-3 text-sm whitespace-nowrap">Settings</span>
            </a>

            <form id="logout-form" class="w-full mt-2" action="{{ route('logout') }}" method="post">
                @csrf

                <button
                    class="items-center w-full px-3 py-2 text-sm font-normal transition duration-300 rounded-md lex h-11 dark:hover:bg-neutral-800/50 hover:bg-neutral-200/50 active:bg-neutral-200"
                    tabindex="-1" type="submit" aria-disabled="true">
                    <span class="flex items-center justify-start w-full" role="menuitem" tabindex="-1"
                        id="user-menu-item-2">

                        <svg class="flex-shrink-0 w-5 h-5 text-indigo-600 transition duration-75" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 text-sm text-left whitespace-nowrap">Logout</span>
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
