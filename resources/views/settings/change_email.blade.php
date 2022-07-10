@extends('layout.layout')
@section('title', 'Change Email')
@section('email-settings-sub-tab', 'email-settings-sub-tab')
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <form action="{{ route('settings.email') }}" method="POST"
        class="flex flex-col w-full gap-2 p-4 bg-white rounded-xl sm:p-5">
        @csrf

        <div class="flex flex-col w-full gap-5 md:flex-row">
            <div class="w-full">
                <label class="text-base font-medium text-neutral-600">Change Email</label>

                <x-success_message />
                <x-warning_message />
                <x-error_message />
                <x-info_message />

                <div class="flex flex-col gap-3 p-3 mt-3 border rounded-md sm:rounded-xl md:p-4">
                    <div class="flex flex-col items-start justify-between w-full gap-4 md:flex-row">
                        <div class="w-full md:w-1/2">
                            <label for="email" class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                Email
                                <span class="text-red-600">*</span>
                            </label>

                            <div class="flex flex-col items-start justify-start gap-1.5">
                                <input type="email" name="email" id="email" placeholder="Enter your email address"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0"
                                    required />

                                <div class="ml-1 text-xs text-neutral-500">
                                    This field is <strong>required</strong>.
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2">
                            <label for="email_confirmation"
                                class="flex text-sm font-medium text-neutral-600 dark:text-neutral-400">
                                Confirm Email
                                <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-col items-start justify-start gap-1.5">
                                <input type="email" name="email_confirmation" id="email_confirmation"
                                    placeholder="Confirm your email address"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 border border-transparent rounded placeholder-neutral-400 bg-neutral-100 h-11 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-indigo-600 focus:ring-0"
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

        <div class="flex items-center justify-end w-full p-3 mt-3 border rounded-md sm:rounded-xl md:p-4">
            <button type="submit"
                class="w-full sm:w-fit py-3 px-10 text-sm font-medium text-white rounded bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 focus:ring focus:ring-indigo-600/40">
                Save
            </button>
        </div>
    </form>
@endsection
