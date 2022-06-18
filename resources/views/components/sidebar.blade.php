<div class="bg-white w-56 h-full py-4 hidden sm:flex justify-between items-start px-5 flex-col">
    <div class="w-full">
        <div class="flex justify-start tracking-wider items-center">
            <a href="{{ route('home') }}" class="home-btn text-2xl sm:text-3xl font-bold">
                <span class="text-neutral-700 dark:text-neutral-200">
                    <span class="text-indigo-600">e</span>Voting
                </span>
            </a>
        </div>

        <div class="mt-5 w-full">
            <ul class="flex flex-col gap-2 w-full justify-start text-neutral-500 items-start">
                <li class="w-full">
                    <a href="{{ route('dashboard') }}" id="@yield('dashboard-tab')" d
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-medium text-lg hover:text-neutral-900">
                        <i class="fas fa-home"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->privilege == 'superuser')
                    <li class="w-full">
                        <a href="{{ route('users') }}" id="@yield('users-tab')"
                            class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-medium text-lg hover:text-neutral-900">
                            <i class="fas fa-users"></i>
                            <span class="text-sm">Users</span>
                        </a>
                    </li>
                @endif
                <li class="w-full">
                    <a href="{{ route('elections') }}" id="@yield('election-tab')"
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-medium text-lg hover:text-neutral-900">
                        <i class="fas fa-box"></i>
                        <span class="text-sm">Election</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('results') }}" id="@yield('results-tab')"
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-medium text-lg hover:text-neutral-900">
                        <i class="fas fa-poll"></i>
                        <span class="text-sm">Results</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('settings') }}" id="@yield('settings-tab')"
                        class="flex items-start gap-2 w-full hover:bg-neutral-200/80 transition duration-300 py-2 px-3 rounded-md font-medium text-lg hover:text-neutral-900">
                        <i class="fas fa-gear"></i>
                        <span class="text-sm">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf

        <button type="submit"
            class="flex items-start gap-2 w-full hover:bg-neutral-200/80 text-neutral-900 transition duration-300 py-2 px-3 rounded-md text-lg">
            <i class="fas fa-sign-out"></i>
            <span class="text-sm">Logout</span>
        </button>
    </form>
</div>
