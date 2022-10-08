@extends('user.home')

@section('title', 'Notifications')

@section('home-page')
    <div class="md:bg-white w-full md:p-5 min-h-fit rounded-2xl text-justify flex flex-col gap-4 lg:max-w-3xl pb-16">
        <div class="flex justify-between items-center w-full relative">
            <h2 class="text-2xl text-[#0000FF] md:text-3xl font-semibold">Notifications</h2>

            <div class="absolute w-full">
                <x-info_message />
                <x-success_message />
                <x-error_message />
            </div>

            <button id="notificationsOptionDropDown" data-dropdown-toggle="notifications-dropdown"
                class="hover:bg-neutral-100 focus:ring focus:ring-black/10 text-[#0000FF] p-1 rounded-md mr-1">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                    </path>
                </svg>
            </button>

            <div id="notifications-dropdown" class="hidden z-10 min-w-[11rem] bg-white rounded-xl shadow-lg border">
                <ul class="text-sm text-neutral-700 p-1.5 gap-1.5 flex flex-col"
                    aria-labelledby="notificationsOptionDropDown">
                    <li>
                        <form action="{{ route('notifications.mark-all') }}" method="post" class="w-full">
                            @csrf

                            <button type="submit"
                                class="flex justify-start items-center gap-1 rounded-lg px-3 py-2 w-full hover:bg-neutral-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
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

        @if ($notifications->count() > 0)
            <div class="flex w-full flex-col gap-2 border-neutral-100 divide-neutral-100">
                @foreach ($notifications as $notification)
                    <x-notification_card_2 :notification="$notification" />
                @endforeach
            </div>
        @else
            <div class="flex w-full justify-center items-center h-32">
                <p class="text-sm md:text-base text-neutral-500 font-semibold text-center tracking-wide">
                    No notifications.
                </p>
            </div>
        @endif
    </div>
@endsection
