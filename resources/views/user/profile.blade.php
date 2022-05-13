@extends('layout.app')

@section('content')
    <div class="user-profile w-full pb-28">
        {{-- profile background image --}}
        <div style="background-image: url('{{ asset('images/profile-bg.jpg') }}');" class="profile-bg-image w-full"></div>

        <div class="profile-image-container -mt-8 mb-6 lg:mb-12">
            <div class="details gap-2 flex justify-start items-end">
                {{-- profile picture --}}
                <div class="profile-img border-white border-4 dark:border-neutral-800"
                    style="background-image: url('{{ asset('images/profile.jpg') }}');"></div>

                {{-- name and email --}}
                <div class="name pb-4">
                    <h2 class="text-xl cursor-default font-bold text-neutral-800 dark:text-neutral-300">{{ $user->name }}
                    </h2>
                    <span class="text-sm font-normal cursor-default text-neutral-500">{{ $user->email }}</span>
                </div>

            </div>
        </div>

        <div class="profile-details mb-10 flex justify-center">
            <form action="{{ route('profile') }}" method="POST">
                @csrf

                {{-- name and username inputs --}}
                <div class="form-input-group gap-4 mt-5 flex justify-center lg:flex-row flex-col">
                    {{-- name input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="name"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</label>
                        <input name="name" type="text" id="name"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->name }}" placeholder="Enter your full name" required>
                    </div>

                    {{-- username input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="username"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Username</label>
                        <input name="username" type="text" id="username"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->username }}" disabled required>
                    </div>
                </div>

                {{-- email and phone input --}}
                <div class="form-input-group gap-4 mt-5 flex justify-center lg:flex-row flex-col">
                    {{-- email input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="email"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</label>
                        <input name="email" type="email" id="email"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->email }}" placeholder="Enter your full email" required>
                    </div>

                    {{-- phone input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="phone"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</label>
                        <input name="phone" type="text" id="phone"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="(+123)-456-789-2568" value="{{ $user->phone }}">
                    </div>
                </div>

                {{-- address input --}}
                <div class="w-full mt-5">
                    <label for="address"
                        class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Address</label>
                    <input name="address" type="text" id="address"
                        class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        value="{{ $user->address }}" placeholder="Address">
                </div>

                {{-- date of birth and nationality inputs --}}
                <div class="form-input-group gap-4 mt-5 flex justify-center lg:flex-row flex-col">
                    {{-- date of birth input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="dob"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Date
                            of Birth</label>
                        <input name="dob" type="date" id="dob"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->dob }}" placeholder="dd/mm/yyyy">
                    </div>

                    {{-- nationality input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="nationality"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Nationality</label>
                        <input name="nationality" type="text" id="nationality"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter your nationality" value="{{ $user->nationality }}">
                    </div>
                </div>

                {{-- city and state inputs --}}
                <div class="form-input-group gap-4 mt-5 flex justify-center lg:flex-row flex-col">
                    {{-- city input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="city"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">City</label>
                        <input name="city" type="text" id="city"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->city }}" placeholder="Enter your City">
                    </div>

                    {{-- state input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="state"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">State</label>
                        <input name="state" type="text" id="state"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter your State" value="{{ $user->state }}">
                    </div>
                </div>

                {{-- zip code and country inputs --}}
                <div class="form-input-group gap-4 mt-5 flex justify-center lg:flex-row flex-col">
                    {{-- zip code input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="code"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Zip
                            Code</label>
                        <input name="code" type="number" id="code"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            value="{{ $user->code }}" placeholder="Enter your zip code">
                    </div>

                    {{-- country input --}}
                    <div class="lg:w-6/12 md:w-full">
                        <label for="country"
                            class="block mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Country</label>
                        <input name="country" type="text" id="country"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Enter your country" value="{{ $user->country }}">
                    </div>
                </div>

                <div class="w-full mt-10">
                    <button type="submit"
                        class="text-white px-12 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded-md text-sm py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                        <svg class="w-5 h-5 mr-1 text-neutral-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
