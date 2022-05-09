<nav id="navbar-container" class="w-full h-auto py-5">
    <div class="flex justify-between px-16 align-middle nav-contents">

        {{-- Logo section --}}
        <div class="flex justify-between align-middle">
            <x-logo />
        </div>

        {{-- login and register buttons --}}
        <div class="flex justify-center gap-4 align-middle">
            <x-button text='Log In' link="{{ route('login') }}" variant="py-2 px-6 shadow-lg" />
        </div>
    </div>
</nav>
