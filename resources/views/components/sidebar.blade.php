@php
$hasNotification = \Illuminate\Support\Facades\DB::table('notifications')
    ->where('user_id', auth()->user()->id)
    ->where('isRead', 0)
    ->get()
    ->count();
@endphp


<div
    class="bg-white sm:relative fixed h-full sidebar-menu py-4 invisible w-0 opacity-0 md:visible md:w-[17rem] md:min-w-[17rem] md:opacity-100 md:flex justify-between items-start px-3.5 sm:px-5 flex-col z-50 border-r">
    <div class="flex flex-col justify-between w-full h-full overflow-y-auto scrollbar-hide scroll-smooth">
        <div class="w-full overflow-y-auto scrollbar-hide scroll-smooth">
            <div class="items-center justify-start hidden tracking-wider sm:flex">
                <a href="{{ route('home') }}" class="text-2xl font-bold home-btn sm:text-3xl">
                    <span class="text-neutral-700 dark:text-neutral-200">
                        <span class="text-[#0000FF]">e</span>Voting
                    </span>
                </a>
            </div>

            <div class="w-full mt-10 sm:mt-5">
                <ul class="flex flex-col items-start justify-start w-full gap-2 text-neutral-500">
                    <li class="w-full">
                        <a href="{{ route('dashboard') }}" id="@yield('dashboard-tab')"
                            class="flex items-start w-full gap-2 p-3 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900">
                            <i class="fas fa-home"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                    </li>

                    <li class="w-full">
                        <button type="button" id="@yield('users-tab')"
                            class="flex items-center justify-between w-full px-3 py-2.5 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900"
                            aria-controls="users-dropdown" data-collapse-toggle="users-dropdown">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-users"></i>
                                <span class="text-sm">Manage Users</span>
                            </div>
                            <svg sidebar-toggle-item class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="users-dropdown"
                            class="hidden ml-5 mt-2 border-l-2 border-neutral-200 pl-3 space-y-3 py-2.5">
                            <li>
                                <a id="@yield('add-users-sub-tab')" href="{{ route('users.add') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    Add User
                                </a>
                            </li>
                            <li>
                                <a id="@yield('view-users-sub-tab')" href="{{ route('users') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    View Users
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="w-full">
                        <button type="button" id="@yield('election-tab')"
                            class="flex items-center justify-between w-full p-3 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900"
                            aria-controls="election-dropdown" data-collapse-toggle="election-dropdown">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-box"></i>
                                <span class="text-sm">Manage Events</span>
                            </div>
                            <svg sidebar-toggle-item class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="election-dropdown"
                            class="hidden ml-5 border-l-2 mt-2 border-neutral-200 pl-3 space-y-3 py-2.5">
                            <li>
                                <a id="@yield('create-elections-sub-tab')" href="{{ route('elections.create') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    Create Election
                                </a>
                            </li>
                            <li>
                                <a id="@yield('view-elections-sub-tab')" href="{{ route('elections.view') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    View Elections
                                </a>
                            </li>
                            <li>
                                <a id="@yield('create-polls-sub-tab')" href="{{ route('polls.create') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    Create Polls
                                </a>
                            </li>
                            <li>
                                <a id="@yield('view-polls-sub-tab')" href="{{ route('polls.view') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/8">
                                    View Polls
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="relative w-full">
                        @if ($hasNotification > 0)
                            <span
                                class="min-h-[0.6rem] absolute z-10 top-[0.6rem] left-[0.65rem] min-w-[0.6rem] max-h-[0.6rem] max-w-[0.6rem] h-[0.6rem] w-[0.6rem] bg-red-600 rounded-full"></span>
                        @endif

                        <a href="{{ route('notifications') }}" id="@yield('notifications-tab')"
                            class="flex items-start w-full gap-2 p-3 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900">
                            <x-icons.bell_icon style="height: 20px; width: 18px;" class="hover:text-neutral-900" />
                            <span class="text-sm">Notifications</span>
                        </a>
                    </li>

                    <li class="w-full">
                        <a href="{{ route('results') }}" id="@yield('results-tab')"
                            class="flex items-start w-full gap-2 p-3 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900">
                            <i class="fas fa-poll"></i>
                            <span class="text-sm">Results</span>
                        </a>
                    </li>

                    <li class="w-full">
                        <button type="button" id="@yield('settings-tab')"
                            class="flex items-center justify-between w-full p-3 text-lg font-normal transition duration-300 rounded-md hover:bg-neutral-200/80 hover:text-neutral-900"
                            aria-controls="settings-dropdown" data-collapse-toggle="settings-dropdown">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-gear"></i>
                                <span class="text-sm">Settings</span>
                            </div>
                            <svg sidebar-toggle-item class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <ul id="settings-dropdown"
                            class="hidden ml-5 border-l-2 mt-2 border-neutral-200 pl-3 space-y-3 py-2.5">
                            {{-- <li>
                                <a id="@yield('profile-settings-sub-tab')" href="{{ route('settings.profile') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/80">
                                    Edit Profile
                                </a>
                            </li> --}}

                            <li>
                                <a id="@yield('email-settings-sub-tab')" href="{{ route('settings.email') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/80">
                                    Change Email
                                </a>
                            </li>

                            <li>
                                <a id="@yield('password-settings-sub-tab')" href="{{ route('settings.password') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/80">
                                    Change Password
                                </a>
                            </li>

                            <li>
                                <a id="@yield('notification-settings-sub-tab')" href="{{ route('settings.notification') }}"
                                    class="flex items-center px-2 py-1 text-sm font-normal transition duration-200 rounded-lg w-fit hover:bg-neutral-100 text-neutral-500 hover:text-neutral-900 hover:bg-neutral-200/80">
                                    Notifications
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        {{-- <x-profile_card /> --}}
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="flex items-center justify-start w-full gap-2 px-2 py-3 text-sm text-neutral-700 font-normal transition duration-300 rounded-md hover:bg-neutral-100 hover:text-neutral-900 hover:bg-neutral-200/80">
                <span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
