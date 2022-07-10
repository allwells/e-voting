<nav id="navbar-container"
    class="fixed z-50 w-full h-auto py-4 bg-white/50 backdrop-blur-sm @yield('nav-border') border-b sm:border-b-0 border-neutral-300">
    <div
        class="justify-start sm:justify-between px-20 items-start sm:items-center nav-contents flex flex-col sm:flex-row w-full">

        {{-- Logo section --}}
        <div class="flex items-center justify-between sm:justify-center align-middle sm:w-fit w-full">
            <x-logo />

            <button type="button"
                class="flex sm:hidden items-center p-1 text-white bg-indigo-600 rounded-sm h-fit w-fit mobile-nav-btn">
                <svg class="w-6 h-6 open-nav-icon" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>

                <svg class="hidden w-6 h-6 close-nav-icon" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div
            class="hidden sm:flex sm:flex-row flex-col items-start sm:items-center gap-4 sm:gap-6 sm:mt-0 mt-5 w-full sm:w-fit mobile-nav-menu">
            {{-- home button --}}
            <a href="{{ route('home') }}"
                class="px-8 py-3 border-neutral-300 text-center font-semibold sm:font-normal @yield('no-home') text-sm sm:text-indigo-600 sm:transition duration-300 bg-neutral-100 sm:bg-white border sm:border-transparent rounded sm:hover:border-indigo-500 h-fit w-full sm:w-fit focus:ring focus:border-indigo-600 focus:ring-neutral-700/20">
                Home
            </a>

            {{-- login button --}}
            <a href="{{ route('login') }}"
                class="px-8 py-3 border-neutral-300 text-center font-semibold sm:font-normal @yield('no-nav') text-sm sm:text-indigo-600 sm:transition sm:duration-300 bg-neutral-100 sm:bg-white border sm:border-transparent rounded sm:hover:border-indigo-500 h-fit w-full sm:w-fit focus:ring focus:border-indigo-600 focus:ring-neutral-700/20">
                Login
            </a>

            {{-- register button --}}
            <a href="{{ route('register') }}"
                class="px-8 py-3 text-center border border-indigo-600 font-semibold sm:font-normal @yield('no-nav') text-sm text-white sm:transition sm:duration-300 bg-indigo-600 rounded sm:hover:bg-indigo-700 focus:ring focus:ring-indigo-600/40 h-fit w-full sm:w-fit">
                Register
            </a>
        </div>
    </div>
</nav>
