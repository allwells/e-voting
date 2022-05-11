<nav id="navbar-container" class="w-full fixed z-50 h-auto py-5 border-b border-gray-100">
    <div class="flex justify-between px-16 align-middle nav-contents">

        {{-- Logo section --}}
        <div class="flex justify-between align-middle">
            <x-logo />
        </div>

        {{-- login and register buttons --}}

        <div>
            <x-button text='Login' link="{{ route('login') }}" variant="py-1 px-6 shadow-lg" />
        </div>
    </div>
</nav>
