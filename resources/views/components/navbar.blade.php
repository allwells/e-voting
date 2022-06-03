<nav id="navbar-container" class="w-full fixed z-50 h-auto py-5 border-b border-gray-100 bg-white/50 backdrop-blur-sm">
    <div class="flex justify-between px-20 align-middle nav-contents">

        {{-- Logo section --}}
        <div class="flex justify-center align-middle items-center">
            <x-logo />
        </div>

        {{-- login and register buttons --}}

        <a href="{{ route('login') }}"
            class="bg-white py-2 h-fit w-fit px-8 font-semibold border-4 border-indigo-600 text-indigo-600 shadow-lg hover:shadow-indigo-300 active:shadow-none transition duration-300">
            Login
        </a>
    </div>
</nav>
