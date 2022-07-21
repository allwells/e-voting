<nav
    class="bg-blue-700 shadow-lg shadow-black/10 backdrop-blur w-full absolute text-white flex items-center jusitify-between py-2 px-5 gap-10">
    <div class="w-1/5">
        <span class="font-bold text-2xl">
            <a href="{{ route('explore') }}">eVoting</a>
        </span>
    </div>

    <div class="flex-grow">
        <form action="#" method="POST" class="flex justify-start items-center w-full">
            <svg class="w-5 h-5 z-10 absolute ml-4" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
            <input type="search" name="search" id="search" placeholder="Search e-Voting..."
                class="h-10 placeholder-white/50 w-full font-medium text-sm px-10 bg-blue-800 text-white rounded-full border border-transparent outline-none hover:border-white/50 focus:border-white focus:ring-0 transition duration-300" />
        </form>
    </div>

    <div class="w-3/12">
        <ul class="flex justify-end items-center gap-5 overflow-visible">
            <li class=" flex justify-center items-center rounded-full">
                <a href="#"
                    class="hover:bg-blue-800 w-fit h-fit rounded-full p-2 focus:ring focus:ring-white/50 notification transition duration-200 flex justify-center items-center">
                    <x-icons.bell_icon class="h-5 w-5 text-white" />
                    <span
                        class="w-3 h-3 absolute bg-red-600 rounded-full border-2 border-blue-700 -mt-5 notify ml-3"></span>
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#"
                    class="hover:bg-blue-800 w-fit h-fit rounded-full p-2 focus:ring focus:ring-white/50 transition duration-200">
                    <x-icons.election_icon class="h-5 w-5 text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#"
                    class="hover:bg-blue-800 w-fit h-fit rounded-full p-2 focus:ring focus:ring-white/50 transition duration-200">
                    <x-icons.chart_icon class="h-5 w-5 text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#"
                    class="hover:bg-blue-800 w-fit h-fit rounded-full p-2 focus:ring focus:ring-white/50 transition duration-200">
                    <x-icons.settings_icon class="h-5 w-5 text-white" />
                </a>
            </li>
        </ul>
    </div>
</nav>
