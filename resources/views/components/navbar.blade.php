<nav id="navbar-container" class="fixed z-50 w-full h-auto py-4 bg-white/50 backdrop-blur-sm">
    <div class="flex justify-between px-20 align-middle nav-contents">

        {{-- Logo section --}}
        <div class="flex items-center justify-center align-middle">
            <x-logo />
        </div>

        <div class="flex items-center gap-6">
            {{-- home button --}}
            <a href="{{ route('home') }}"
                class="px-8 py-3 font-normal @yield('no-home') text-sm text-indigo-600 transition duration-300 bg-white border border-transparent rounded hover:border-indigo-500 h-fit w-fit">
                Home
            </a>

            {{-- login button --}}
            <a href="{{ route('login') }}"
                class="px-8 py-3 font-normal @yield('no-nav') text-sm text-indigo-600 transition duration-300 bg-white border border-transparent rounded hover:border-indigo-500 h-fit w-fit">
                Login
            </a>

            {{-- register button --}}
            <a href="{{ route('register') }}"
                class="px-8 py-3 border border-indigo-600 font-normal @yield('no-nav') text-sm text-white transition duration-300 bg-indigo-600 rounded hover:bg-indigo-700 focus:ring focus:ring-indigo-300 h-fit w-fit">
                Register
            </a>
        </div>
    </div>
</nav>
