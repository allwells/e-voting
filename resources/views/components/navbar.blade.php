<nav id="navbar-container" class="fixed z-50 w-full h-auto py-4 bg-white sm:bg-transparent">
    <div class="flex justify-between px-20 align-middle nav-contents">

        {{-- Logo section --}}
        <div class="flex items-center justify-center align-middle">
            <x-logo />
        </div>

        <div class="flex items-center gap-6">
            {{-- home button --}}
            <a href="{{ route('home') }}"
                class="px-4 py-1 mt-1 font-semibold @yield('no-home') text-center transition duration-300 rounded-md text-neutral-600 hover:text-indigo-600 hover:bg-neutral-100 h-fit w-fit">
                Home
            </a>

            {{-- login button --}}
            <a href="{{ route('login') }}"
                class="px-5 py-1.5 font-semibold @yield('no-nav') text-indigo-600 transition duration-300 bg-white border border-transparent rounded-md shadow-lg hover:border-indigo-500 h-fit w-fit shadow-neutral-300">
                Log in
            </a>
        </div>
    </div>
</nav>
