@extends('layout.layout')

@section('title', 'Profile')

@section('views')
    <div class="w-full -mt-1 user-profile">
        {{-- profile background image --}}
        <div style="background-image: url('{{ asset('images/profile-bg.jpg') }}');" class="w-full profile-bg-image"></div>

        <div class="mb-6 -mt-8 profile-image-container lg:mb-12">
            <div class="flex items-end justify-start gap-2 details">
                {{-- profile picture --}}
                <div class="border-4 border-white profile-img dark:border-neutral-800"
                    style="background-image: url('{{ asset('images/profile.jpg') }}');"></div>

                {{-- name and email --}}
                <div class="pb-4 name">
                    <h2 class="text-xl flex gap-1 font-semibold cursor-default text-neutral-800 dark:text-neutral-300">
                        {{ $user->fname }}
                        {{ $user->lname }}
                    </h2>
                    <span class="text-sm font-normal cursor-default text-neutral-500">{{ $user->email }}</span>
                </div>

            </div>
        </div>

        <div class="flex justify-center mb-10 profile-details">
            <div class="flex flex-col gap-4 w-full">

                {{-- first name and last name inputs --}}
                <div class="flex flex-col justify-center gap-4 form-input-group lg:flex-row">
                    {{-- first name input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="fname"
                            class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">First
                            Name</label>
                        <input name="fname" type="text" id="fname"
                            class="bg-neutral-50 border hover:border-neutral-500 text-neutral-600 transition duration-300 border-neutral-300 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->fname }}" disabled>
                    </div>

                    {{-- last name input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="lname"
                            class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Last
                            Name</label>
                        <input name="lname" type="text" id="lname"
                            class="bg-neutral-50 border hover:border-neutral-500 text-neutral-600 transition duration-300 border-neutral-300 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->lname }}" disabled>
                    </div>
                </div>

                {{-- email and phone input --}}
                <div class="flex flex-col justify-center gap-4 form-input-group lg:flex-row">
                    {{-- email input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Email</label>
                        <input name="email" type="email" id="email"
                            class="bg-neutral-50 border hover:border-neutral-500 text-neutral-600 transition duration-300 border-neutral-300 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->email }}" disabled>
                    </div>

                    {{-- phone input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="phone"
                            class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">Phone</label>
                        <input name="phone" type="text" id="phone"
                            class="bg-neutral-50 border hover:border-neutral-500 text-neutral-600 transition duration-300 border-neutral-300 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->phone }}" disabled>
                    </div>
                </div>

                {{-- date of birth and nationality inputs --}}
                <div class="flex flex-col justify-center gap-4 form-input-group lg:flex-row">
                    {{-- date of birth input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="dob" class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                            Date of Birth
                        </label>
                        <input name="dob" type="date" id="dob"
                            class="bg-neutral-50 border hover:border-neutral-500 text-neutral-600 transition duration-300 border-neutral-300 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->dob }}" disabled>
                    </div>

                    <div class="lg:w-6/12 md:w-full"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
