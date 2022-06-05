@extends('layout.layout')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-40">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Registration
            </h2>
            <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                <form id="voter-reg-form" class="flex flex-col items-center justify-start mt-8 space-y-8"
                    action="{{ route('register') }}" method="POST">
                    @csrf

                    <div id="success-msg"
                        class="items-center justify-start hidden w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-emerald-300 text-emerald-800 bg-emerald-200 h-fit">
                    </div>

                    <input type="hidden" name="remember" value="true">
                    <div class="flex flex-col w-full gap-4">

                        <div class="flex flex-col gap-4 md:flex-row">
                            {{-- email input field --}}
                            <div class="w-full">
                                <label for="email" class="font-semibold text-gray-700">Email
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="email" name="email" type="email"
                                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                                    placeholder="Enter your email" value="{{ old('email') }}">

                                <span id='email-error' class="text-red-600 text-md error-text"></span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-4 md:flex-row">
                            {{-- phone number field --}}
                            <div class="w-full">
                                <label for="email" class="font-semibold text-gray-700">Phone
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="phone" name="phone" type="tel"
                                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                                    placeholder="Enter your phone number" value="{{ old('phone') }}">

                                <span id='phone-error' class="text-red-600 text-md error-text"></span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-4 md:flex-row">
                            {{-- password input field --}}
                            <div class="w-full">
                                <label for="password" class="font-semibold text-gray-700">Password
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input id="password" name="password" type="password"
                                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                                    placeholder="Enter your password" value="{{ old('password') }}">

                                <span id='password-error' class="text-red-600 text-md error-text"></span>
                            </div>
                        </div>
                    </div>

                    {{-- register button --}}
                    <div class="flex items-center justify-center w-full border lg:w-2/5 sm:w-3/5">
                        <button type="submit"
                            class="w-full h-12 font-semibold text-white transition duration-300 bg-indigo-600 border-2 border-white shadow-xl signup-submit-btn ring-1 ring-indigo-600 hover:shadow-indigo-300 active:shadow-none">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
