@extends('user.settings')
@section('title', 'Change Email')
@section('email-settings-sub-tab', 'email-settings-sub-tab')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('settings-page')
    <form action="{{ route('settings.email') }}" method="POST"
        class="flex flex-col w-full gap-2 p-4 bg-white rounded-xl sm:p-5">
        @csrf

        <div class="flex flex-col w-full gap-5 md:flex-row">
            <div class="w-full">
                <label class="text-base font-bold text-neutral-800">Change Email</label>

                <x-success_message />
                <x-warning_message />
                <x-error_message />
                <x-info_message />

                <div class="flex flex-col gap-3 p-3 mt-3 border rounded-md sm:rounded-xl md:p-4">
                    <div class="flex flex-col items-start justify-between w-full gap-4 md:flex-row">
                        <div class="w-full md:w-1/2">
                            <label for="email" class="flex text-sm font-medium text-neutral-800 dark:text-neutral-400">
                                Email
                                <span class="text-red-600">*</span>
                            </label>

                            <div class="flex flex-col items-start justify-start gap-1.5">
                                <input type="email" name="email" id="email" placeholder="Enter your email address"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-800 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                    required />

                                <div class="ml-1 text-xs text-neutral-500">
                                    This field is <strong>required</strong>.
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2">
                            <label for="email_confirmation"
                                class="flex text-sm font-medium text-neutral-800 dark:text-neutral-400">
                                Confirm Email
                                <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-col items-start justify-start gap-1.5">
                                <input type="email" name="email_confirmation" id="email_confirmation"
                                    placeholder="Confirm your email address"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded-lg placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-800 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                                    required />

                                <div class="ml-1 text-xs text-neutral-500">
                                    Ensure that this email <strong>matches</strong> the one above.
                                </div>
                            </div>
                        </div>
                    </div>
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
