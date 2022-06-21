<div
    class="bg-white w-72 sm:relative fixed h-full sidebar-menu py-4 hidden md:flex justify-between items-start px-3.5 sm:px-5 flex-col">
    <div class="w-full">
        <div class="hidden sm:flex justify-start tracking-wider items-center">
            <a href="{{ route('home') }}" class="home-btn text-2xl sm:text-3xl font-bold">
                <span class="text-neutral-700 dark:text-neutral-200">
                    <span class="text-indigo-600">e</span>Voting
                </span>
            </a>
        </div>

        <div class="mt-10 sm:mt-5 w-full">
            <ul class="flex flex-col gap-2 w-full justify-start text-neutral-500 items-start">
                <li class="w-full">
                    <a href="{{ route('dashboard') }}" id="@yield('dashboard-tab')" d
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-lg hover:text-neutral-900">
                        <i class="fas fa-home"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->privilege == 'superuser')
                    <li class="w-full">
                        <a href="{{ route('users') }}" id="@yield('users-tab')"
                            class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-base hover:text-neutral-900">
                            <i class="fas fa-users"></i>
                            <span class="text-sm">Users</span>
                        </a>
                    </li>
                @endif
                <li class="w-full">
                    @if (auth() && auth()->user()->privilege != 'superuser' && (auth() && auth()->user()->privilege != 'admin'))
                        <a href="{{ route('elections.view') }}" id="@yield('election-tab')"
                            class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-lg hover:text-neutral-900">
                            <i class="fas fa-box"></i>
                            <span class="text-sm">Election</span>
                        </a>
                    @else
                        <button type="button" id="@yield('election-tab')"
                            class="flex items-center justify-between w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-lg hover:text-neutral-900"
                            aria-controls="election-dropdown" data-collapse-toggle="election-dropdown">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-box"></i>
                                <span class="text-sm">Manage Elections</span>
                            </div>
                            <svg sidebar-toggle-item class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="election-dropdown"
                            class="hidden ml-5 border-l-2 border-neutral-200 pl-3 space-y-3 py-2.5">
                            <li>
                                <a href="{{ route('elections.create') }}"
                                    class="flex items-center w-fit hover:bg-neutral-100 px-2 py-1 text-sm font-normal text-neutral-500 hover:text-neutral-900 rounded transition duration-200 hover:bg-neutral-200/8">
                                    Create Election
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('elections.view') }}"
                                    class="flex items-center w-fit hover:bg-neutral-100 px-2 py-1 text-sm font-normal text-neutral-500 hover:text-neutral-900 rounded transition duration-200 hover:bg-neutral-200/8">
                                    View Elections
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>

                <li class="w-full">
                    <a href="{{ route('results') }}" id="@yield('results-tab')"
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-lg hover:text-neutral-900">
                        <i class="fas fa-poll"></i>
                        <span class="text-sm">Results</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('settings') }}" id="@yield('settings-tab')"
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-normal text-lg hover:text-neutral-900">
                        <i class="fas fa-gear"></i>
                        <span class="text-sm">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="w-full mt-2 sm:mt-0">
        @csrf

        <button type="submit"
            class="flex items-start gap-2 w-full hover:bg-neutral-200/80 text-neutral-900 transition duration-300 py-2 px-3 rounded-md text-lg">
            <i class="fas fa-sign-out"></i>
            <span class="text-sm">Logout</span>
        </button>
    </form>
</div>
