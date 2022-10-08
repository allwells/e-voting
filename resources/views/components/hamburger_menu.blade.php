@php
// get all notifications
$notifications = \DB::table('notifications')
    ->where('user_id', Auth::user()->id)
    ->paginate(10)
    ->reverse()
    ->values();

// Get notifications that have not been read
$unreadNotifications = \DB::table('notifications')
    ->where('user_id', Auth::user()->id)
    ->where('isRead', false)
    ->get();
@endphp

<div
    class="h-fit min-h-screen bg-[#0000FF] gap-10 z-50 md:hidden tracking-wide flex flex-col justify-between items-start hamburger-menu absolute top-0 right-0 left-0 w-full p-7 opacity-0 invisible">
    <div class="relative flex justify-between items-center w-full">
        <div class="flex justify-start items-center gap-3">
            <div class="h-14 w-14 min-h-[3.5rem] min-w-[3.5rem]">
                @if (!Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                        class="flex-shrink-0 rounded-full shadow-lg shadow-black/30 md:h-24 md:w-24" />
                @else
                    <svg class="flex-shrink-0 bg-[#0000FF] border-2 border-[#0000FF] rounded-full shadow-xl shadow-black/40 md:h-24 md:w-24"
                        fill="currentColor" viewBox="2.2 2.2 15.6 15.6" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd"></path>
                    </svg>
                @endif
            </div>
            <div class="flex flex-col justify-center items-start">
                <p class="text-base font-semibold text-white m-0">{{ Auth::user()->name }}</p>
                <p class="text-xs line-clamp-1 font-medium text-neutral-200 m-0">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <button type="button" class="hamburger-btn-close text-white outline-0 border-0">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="w-full h-auto flex-grow">
        <ul class="text-base font-medium text-white flex flex-col gap-7 items-start justify-start">
            <li class="w-fit h-fit">
                <a href="https://voices.i-amvocal.org" target="_blank"
                    class="flex items-center justify-start gap-2 w-fit h-fit">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Voices Home
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('explore') }}" class="flex items-center justify-start gap-3 w-fit h-fit">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z"></path>
                        <path
                            d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1zM3 15a2 2 0 114 0 2 2 0 01-4 0z">
                        </path>
                    </svg>
                    Explore
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('elections.view') }}" title="Previous elections"
                    class="flex justify-start items-center gap-4 w-fit h-fit">
                    <x-icons.election_icon style="height: 22px; width: 22px;" class="text-white" />
                    Elections
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('polls.view') }}" title="Polls"
                    class="flex justify-start items-center gap-4 w-fit h-fit">
                    <x-icons.polling_icon class="text-white w-6 h-6" />
                    Polls
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('results') }}" title="Results"
                    class="flex justify-start items-center gap-5 w-fit h-fit">
                    <x-icons.chart_icon style="height: 19px; width: 19px;" class="text-white" />
                    Results
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('notifications') }}" title="Notifications"
                    class="flex justify-start items-center gap-4 w-fit h-fit relative">
                    <x-icons.bell_icon style="height: 23px; width: 23px;" class="text-white" />
                    Notifications
                    @if ($unreadNotifications->count() > 0)
                        <span
                            class="w-[14px] h-[14px] absolute bg-red-600 border-2 border-[#0000FF] rounded-full -mt-5 ml-2.5"></span>
                    @endif
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="{{ route('settings') }}" title="Settings"
                    class="flex justify-start items-center gap-3 w-fit h-fit">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Settings
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="https://voices.i-amvocal.org/about" target="_blank" rel="noreferrer"
                    class="flex items-center justify-start gap-3.5 w-fit h-fit">
                    <x-icons.information_icon style="width: 26px; height: 26px;" class="flex-shrink-0" />
                    About
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="#" class="flex items-center justify-start gap-3.5 w-fit h-fit">
                    <x-icons.questionmark_icon style="width: 26px; height: 26px;" class="flex-shrink-0" />
                    FAQs
                </a>
            </li>

            <li class="w-fit h-fit">
                <a href="#" class="flex items-center justify-start gap-3 w-fit h-fit">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                        <path fill-rule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Support
                </a>
            </li>
        </ul>
    </div>

    <div class="w-full h-fit text-white">
        <form action="{{ route('logout') }}" method="POST">
            <button type="submit" class="text-base font-medium h-fit flex justify-start items-center gap-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
