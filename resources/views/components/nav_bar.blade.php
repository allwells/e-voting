@php
// get all notifications
$notifications = \DB::table('notifications')
    ->where('user_id', auth()->user()->id)
    ->paginate(10)
    ->reverse()
    ->values();

// Get notifications that have not been read
$unreadNotifications = \DB::table('notifications')
    ->where('user_id', auth()->user()->id)
    ->where('isRead', false)
    ->get();
@endphp

<nav
    class="md:shadow-lg z-50 shadow-black/10 w-full h-auto bg-[#0000FF] absolute text-white md:border-b md:border-neutral-100 flex items-center jusitify-between md:py-2 md:px-5 gap-5">
    <div
        class="lg:max-w-[210px] flex-grow md:block flex justify-between items-center md:bg-transparent bg-white md:py-0 py-4 md:px-0 px-5">
        <div class="md:hidden flex justify-center items-center">
            <button type="button">
                <svg class="w-8 h-8 text-[#0000FF]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <span class="md:font-bold flex-grow md:flex-grow-0 text-[30px] md:block flex justify-center items-center">
            <a href="{{ route('explore') }}" class="md:block hidden">eVoting</a>

            <a href="{{ route('explore') }}" class="md:hidden">
                <x-icons.voices_logo class="" style="color:#0000FF;  width:100px; height:25px;" />
            </a>
        </span>

        <div class="md:hidden flex justify-center items-center">
            <button type="button" data-modal-toggle="search-modal">
                <svg class="w-6 h-6" style="color: #0000FF;" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.1111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.1111C15.2222 4.18375 12.0385 1 8.1111 1C4.18375 1 1 4.18375 1 8.1111C1 12.0385 4.18375 15.2222 8.1111 15.2222Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M17 17.0005L13.1333 13.1338" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <div id="search-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed border-b top-0 bg-white/20 backdrop-blur right-0 left-0 z-50 w-full">
                <div class="relative w-full flex-grow flex justify-end items-center p-3">
                    <div class="absolute flex justify-end items-center right-5">
                        <button type="button"
                            class="text-neutral-500 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                            data-modal-toggle="search-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form class="flex-grow w-full" action="#">
                        <input type="text" name="search" id="search"
                            class="outline-0 border-0 bg-transparent h-14 text-neutral-800 font-bold text-sm flex-grow w-full pr-10 focus:ring-0"
                            placeholder="Search e-Voting..." required>
                    </form>
                </div>
            </div>
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

    <div class="lg:max-w-[370px] md:w-full md:flex md:justify-end items-center hidden">
        <ul class="flex justify-end items-center gap-6 overflow-visible">
            <li class=" flex justify-center items-center rounded-full">

                <a href="{{ route('notifications') }}" class="hover:underline text-sm">
                    <x-icons.bell_icon style="height: 23.33px; width: 20px;" class="text-white" />
                    @if ($unreadNotifications->count() > 0)
                        <span
                            class="w-3 h-3 absolute bg-red-600 rounded-full border-2 border-[#0000FF] -mt-5 ml-2.5"></span>
                    @endif
                </a>

                {{-- <button type="button" id="notificationDropdownButton" data-dropdown-toggle="notificationDropdown"
                    class="w-fit h-fit rounded-full p-2 notification flex justify-center items-center">
                    <x-icons.bell_icon style="height: 23.33px; width: 20px;" class="text-white" />
                    @if ($unreadNotifications->count() > 0)
                        <span
                            class="w-3 h-3 absolute bg-red-600 rounded-full border-2 border-[#0000FF] -mt-5 ml-2.5"></span>
                    @endif
                </button>

                <!-- Notification dropdown menu -->
                <div id="notificationDropdown"
                    class="hidden border overflow-hidden z-10 w-full max-w-sm bg-white rounded-xl divide-y divide-neutral-100 shadow-lg">
                    <div
                        class="py-2 flex justify-between items-center px-4 font-bold text-center text-neutral-700 bg-neutral-50">
                        <span>Notifications</span>

                        <button id="notificationOptionDropDown" data-dropdown-toggle="notification-dropdown"
                            class="hover:bg-neutral-100 focus:ring focus:ring-black/10 hover:text-neutral-800 p-1 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                </path>
                            </svg>
                        </button>

                        <div id="notification-dropdown"
                            class="hidden z-10 text-left min-w-[11rem] bg-white rounded-xl font-normal shadow-lg border">
                            <ul class="text-sm text-neutral-700 p-1.5 gap-1.5 flex flex-col"
                                aria-labelledby="notificationOptionDropDown">
                                <li>
                                    <form action="{{ route('notifications.mark-all') }}" method="post"
                                        class="w-full">
                                        @csrf

                                        <button type="submit"
                                            class="flex justify-start items-center gap-1 rounded-lg px-3 py-2 w-full hover:bg-neutral-100">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Mark all as read
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex justify-start items-center gap-1 rounded-lg px-3 py-2 hover:bg-neutral-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Notifications Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div style="max-height: 16rem; min-height:8rem;"
                        class="divide-y divide-neutral-100 overflow-y-scroll">
                        @foreach ($notifications as $notification)
                            <x-notification_card :notification="$notification" />
                        @endforeach

                        <div class="block py-2 px-4 font-bold text-center text-neutral-700 bg-neutral-50">
                            <a href="{{ route('notifications') }}" class="hover:underline text-sm text-blue-600">
                                View all notifications
                            </a>
                        </div>
                    </div>
                </div> --}}
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="{{ route('elections.view') }}" class="w-fit h-fit rounded-full p-2">
                    <x-icons.election_icon style="height: 20px; width: 20px;" class="text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="{{ route('results') }}" class="w-fit h-fit rounded-full p-2">
                    <x-icons.chart_icon style="height: 19px; width: 19px;" class="text-white" />
                </a>
            </li>

            <li class=" flex justify-center items-center rounded-full">
                <a href="{{ route('settings') }}" class="w-fit h-fit rounded-full p-2">
                    <x-icons.settings_icon style="height: 25px; width: 25px;" class="text-white" />
                </a>
            </li>
        </ul>
    </div>
</nav>
