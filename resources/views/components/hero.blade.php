<div class="relative flex justify-center pt-10 overflow-hidden align-top bg-white hero-background sm:pt-20">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col justify-start mt-16 align-middle sm:text-center lg:text-left">
            <div class="flex justify-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-center text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Facilitate your</span>
                    <span class="block text-indigo-600 xl:inline">online voting</span>
                </h1>
            </div>

            <div class="flex justify-center mt-3 align-middle sm:mt-5 md:mt-5 sm:mx-auto lg:mx-0">
                <p class="w-full text-base text-center text-neutral-700 sm:text-lg sm:max-w-2xl md:text-xl">
                    Anim aute id magna irure qui lorem cupidatat aliqua ad ad non deserunt sunt. Qui irure qui lorem
                    cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua magna aliqua ad ad non
                    deserunt sunt.
                </p>
            </div>

            <div class="flex justify-center mt-3 align-middle sm:py-6 sm:mt-6 gap-5">
                <a href="{{ route('register') }}"
                    class="sm:px-8 sm:py-3 px-4 py-2 border border-indigo-600 font-normal @yield('no-nav') text-sm text-white transition duration-300 bg-indigo-600 rounded hover:bg-indigo-700 focus:ring focus:ring-indigo-300 h-fit w-fit">
                    Get Started
                </a>

                <a href="#how-it-works"
                    class="sm:px-8 sm:py-3 px-4 py-2 font-normal @yield('no-nav') text-sm text-neutral-600 transition duration-300 bg-white rounded border border-neutral-400 hover:text-indigo-600 hover:border-indigo-600 h-fit w-fit">
                    See How It Works
                </a>
            </div>
        </div>
    </div>
</div>
