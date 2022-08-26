@extends('layout.layout')

@section('title', 'Add User')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')
@section('add-users-sub-tab', 'add-users-sub-tab')

@section('views')
    <div class="w-full bg-white flex flex-col rounded-xl p-4 sm:p-5">
        <label class="text-neutral-700 font-bold text-sm sm:text-base">Add User</label>

        <x-success_message />
        <x-error_message />
        <x-warning_message />

        <form action="{{ route('users.add') }}" method="POST" class="mt-3 w-full flex flex-col gap-5 add-users-for">
            @csrf

            <div class="sm:border sm:rounded-xl flex flex-col gap-3 w-full sm:p-6">
                <div class="w-full flex sm:flex-row flex-col gap-5">
                    <div class="w-full sm:w-6/12">
                        <label for="fname" class="text-sm font-medium text-neutral-600">
                            First Name
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]"
                            required />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="lname" class="text-sm font-medium text-neutral-600">
                            Last Name
                        </label>

                        <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]" />
                    </div>
                </div>

                <div class="w-full flex sm:flex-row flex-col gap-5">
                    <div class="w-full sm:w-6/12">
                        <label for="phone" class="text-sm font-medium text-neutral-600">
                            Phone
                        </label>

                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]" />
                    </div>

                    <div class="w-full sm:w-6/12">
                        <label for="email" class="text-sm font-medium text-neutral-600">
                            Email
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="email" name="email" id="email" placeholder="Enter your email address"
                            class="mt-1 w-full text-sm px-3 transition duration-300 border border-transparent rounded-lg h-11 outline-0 bg-neutral-100 text-neutral-600 hover:border-neutral-300 focus:ring-0 focus:border-[#0000FF]"
                            required />
                    </div>
                </div>

                <div class="w-full flex justify-end items-center mt-2">
                    <button type="submit"
                        class="w-full sm:w-fit py-2.5 px-5 text-sm font-bold text-white rounded-md bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 flex justify-center items-center gap-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                            </path>
                        </svg>
                        Add User
                    </button>
                </div>
            </div>
        </form>

        <div class="w-full flex justify-between items-center gap-3 my-8">
            <div class="border-b border-dashed flex-grow border-neutral-300"></div>
            <span class="text-lg font-bold uppercase text-neutral-400">Or</span>
            <div class="border-b border-dashed flex-grow border-neutral-300"></div>
        </div>


        <label class="text-neutral-700 font-bold text-sm sm:text-base mb-3">File Upload</label>

        <div class="w-full relative sm:border sm:rounded-xl sm:p-6">

            <label class="text-neutral-700 font-bold text-sm uppercase mb-5">Instructions</label>

            <div class="w-full mb-3">
                <h3 class="text-neutral-800 text-sm">
                    File Format: <span class="font-bold">.csv</span>, <span class="font-bold">.xlsx</span>, and <span
                        class="font-bold">.xls</span> only.
                </h3>

                <div class="mt-3">
                    <h3 class="font-semibold text-neutral-700 text-sm">
                        Valid Inputs:
                    </h3>
                    <ul class="mb-3 list-disc pl-4 text-sm text-neutral-700">
                        <li>First Name</li>
                        <li>Last Name</li>
                        <li>Email</li>
                    </ul>

                    <h3 class="mb-2 text-neutral-700 text-sm">
                        The user inputs are extracted as shown in the image below.
                    </h3>
                    <img src="{{ asset('images/file_upload_format.png') }}" alt="file upload format image" height="100" />
                </div>
            </div>

            <form action="{{ route('users.file-import') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col justify-start items-start gap-2 mt-6">
                @csrf

                <label for="imported_file" class="text-sm font-medium text-neutral-600">
                    File to upload
                    <span class="text-rose-500">*</span>
                </label>

                <div class="flex justify-end items-center flex-grow w-full">
                    <input type="file" name="imported_file" id="imported_file"
                        class="w-full px-3 flex-grow text-sm transition duration-300 border cursor-pointer border-neutral-100 rounded-lg placeholder-neutral-400 bg-neutral-100 h-10 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0"
                        required />

                    <button type="submit"
                        class="flex justify-center items-center gap-1 bg-[#0000FF] py-1.5 px-2 mr-1 absolute rounded-md shadow-md hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 text-white text-sm font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
