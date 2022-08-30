@extends('layout.layout')
@section('title', 'Change Email')
@section('notification-settings-sub-tab', 'notification-settings-sub-tab')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <form action="{{ route('settings.notification') }}" method="POST"
        class="flex flex-col w-full gap-2 p-4 bg-white rounded-xl sm:p-5">
        @csrf

        <div class="flex flex-col w-full gap-5 md:flex-row">
            <div class="w-full">
                <label class="text-base font-bold text-neutral-800">Notifications</label>

                <x-success_message />
                <x-warning_message />
                <x-error_message />

                <div class="flex flex-col gap-3 p-3 mt-3 border rounded-xl sm:p-6">
                    <div class="flex items-center justify-between px-2 py-1 border rounded-md sm:px-4 sm:py-2">
                        <div class="text-neutral-700">
                            <p class="text-sm font-bold">Email Notification</p>
                            <span class="text-xs">Get email notifications about election results.</span>
                        </div>

                        <div>
                            <input type="checkbox" name="email_notification" id="email_notification"
                                class="w-5 h-5 text-[#0000FF] border rounded border-neutral-400 focus:ring-[#0000FF]/50 focus:ring-2"
                                @if (auth()->user()->email_notifications == 'on') @checked(true) @endif />
                        </div>
                    </div>

                    {{-- <div class="flex items-center justify-between px-2 py-1 border rounded-md sm:px-4 sm:py-2">
                        <div class="text-neutral-700">
                            <p class="text-sm font-bold">Email Notification</p>
                            <span class="text-xs">Get email notifications about election results.</span>
                        </div>

                        <div>
                            <input type="checkbox" name="email_notification" id="email_notification"
                                class="w-5 h-5 text-[#0000FF] border rounded border-neutral-400 focus:ring-[#0000FF]/50 focus:ring-2"
                                @if (auth()->user()->email_notifications == 'on') @checked(true) @endif />
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>


        <div class="flex items-center justify-end w-full mt-3">
            <button type="submit"
                class="w-full flex justify-center items-center gap-1 sm:w-fit py-2.5 px-6 text-sm font-bold tracking-wide text-white rounded-lg bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                    </path>
                </svg>
                Save
            </button>
        </div>
    </form>
@endsection
