<nav style="background-color: #0000FF; height: auto;"
    class="md:shadow-lg shadow-black/10 w-full absolute text-white md:border-b md:border-neutral-100 flex items-center jusitify-between md:py-2 md:px-5 gap-10">
    <div
        class="md:w-1/5 w-full md:block flex justify-between items-center md:bg-transparent bg-white md:py-0 py-4 md:px-0 px-5">
        <div class="md:hidden flex justify-center items-center">
            <button type="button">
                <svg class="w-8 h-8" style="color: #0000FF;" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <span class="md:font-bold flex-grow md:flex-grow-0 md:block flex justify-center items-center"
            style="font-size: 30px;">
            <a href="{{ route('explore') }}" class="md:block hidden">eVoting</a>

            <a href="{{ route('explore') }}" class="md:hidden">
                <x-icons.voices_logo class="" style="color:#0000FF;  width:100px; height:25px;" />
            </a>
        </span>

        <div class="md:hidden flex justify-center items-center">
            <button type="button">
                <svg class="w-6 h-6" style="color: #0000FF;" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.1111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.1111C15.2222 4.18375 12.0385 1 8.1111 1C4.18375 1 1 4.18375 1 8.1111C1 12.0385 4.18375 15.2222 8.1111 15.2222Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M17 17.0005L13.1333 13.1338" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <div class="flex-grow md:flex hidden">
        <form action="#" method="POST" class="flex justify-start items-center w-full">
            <svg class="w-4 h-4 z-10 absolute ml-4 text-white" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.1111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.1111C15.2222 4.18375 12.0385 1 8.1111 1C4.18375 1 1 4.18375 1 8.1111C1 12.0385 4.18375 15.2222 8.1111 15.2222Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M17 17.0005L13.1333 13.1338" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <input type="search" name="search" id="search" placeholder="Search e-Voting..."
                style="background-color: #0000CC;"
                class="h-10 placeholder-white/70 w-full font-bold text-base px-10 text-white rounded-full border border-transparent outline-none hover:border-blue-400 focus:border-blue-50 focus:ring-0 transition duration-300" />
        </form>
    </div>

    <div class="w-3/12 md:flex md:justify-end items-center hidden">
        <ul class="flex justify-end items-center gap-6 overflow-visible">
            <li class=" flex justify-center items-center rounded-full">
                <button type="button" id="notificationDropdownButton" data-dropdown-toggle="notificationDropdown"
                    class="w-fit h-fit rounded-full p-2 notification flex justify-center items-center">
                    <x-icons.bell_icon style="height: 23.33px; width: 20px;" class="text-white" />
                    <span style="border-color: #0000FF;"
                        class="w-3 h-3 absolute bg-red-600 rounded-full border-2 -mt-5 notify ml-2.5"></span>
                </button>

                <!-- Notification dropdown menu -->
                <div id="notificationDropdown"
                    class="hidden border overflow-hidden z-10 w-full max-w-sm bg-white rounded-xl divide-y divide-neutral-100 shadow-lg">
                    <div class="block py-2 px-4 font-bold text-center text-neutral-700 bg-neutral-50">
                        Notifications
                    </div>
                    <div class="divide-y divide-neutral-100">
                        <a href="#" class="flex py-3 px-4 hover:bg-neutral-100">
                            <div class="flex-shrink-0">
                                <img class="w-11 h-11 rounded-full" src="{{ asset('images/profile.jpg') }}"
                                    alt="Jese image">
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-neutral-500 text-sm mb-1.5 line-clamp-2">New message from
                                    <span class="font-semibold text-neutral-900">
                                        KAYTRANADA</span>: "Hey,
                                    what's up? All set for the presentation?"
                                </div>
                                <div class="text-xs text-blue-600">a few moments ago</div>
                            </div>
                        </a>
                        <a href="#" class="flex py-3 px-4 hover:bg-neutral-100">
                            <div class="flex-shrink-0">
                                <img class="w-11 h-11 rounded-full" src="{{ asset('images/profile.jpg') }}"
                                    alt="Jese image">
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-neutral-500 text-sm mb-1.5 line-clamp-2">New message from
                                    <span class="font-semibold text-neutral-900">Jese Leos</span>:
                                    "Hey, what's up? All set for the presentation?"
                                </div>
                                <div class="text-xs text-blue-600">2 hours ago</div>
                            </div>
                        </a>
                        <a href="#" class="flex py-3 px-4 hover:bg-neutral-100">
                            <div class="flex-shrink-0">
                                <img class="w-11 h-11 rounded-full" src="{{ asset('images/profile.jpg') }}"
                                    alt="Jese image">
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-neutral-500 text-sm mb-1.5 line-clamp-2">New message from
                                    <span
                                        class="font-semibold text-neutral-900">{{ auth()->user()->fname . ' ' . auth()->user()->lname }}</span>:
                                    "Hey, what's up? Have you taken the package to the warehouse? If not, bring it
                                    back."
                                </div>
                                <div class="text-xs text-blue-600">1 day ago</div>
                            </div>
                        </a>
                    </div>
                    <div class="block py-2 px-4 font-bold text-center text-neutral-700 bg-neutral-50">
                        <a href="#" class="hover:underline text-sm text-blue-600">View all notifications</a>
                    </div>
                </div>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#" class="w-fit h-fit rounded-full p-2">
                    <x-icons.election_icon style="height: 20px; width: 20px;" class="text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#" class="w-fit h-fit rounded-full p-2">
                    <x-icons.chart_icon style="height: 19px; width: 19px;" class="text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="#" class="w-fit h-fit rounded-full p-2">
                    <x-icons.settings_icon style="height: 25px; width: 25px;" class="text-white" />
                </a>
            </li>
        </ul>
    </div>
</nav>
