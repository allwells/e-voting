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
                </div>
            </div>
        </div>


        <div class="flex items-center justify-end w-full mt-3">
            <button type="submit"
                class="w-full sm:w-fit py-3 px-10 text-sm font-bold text-white rounded-lg bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30">
                Save
            </button>
        </div>
    </form>
@endsection
