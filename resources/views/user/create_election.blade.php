@extends('user.home')

@section('title', 'Create Election')

@section('home-page')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:px-5 sm:py-6 min-h-fit">
        <div>
            <h2 class="text-xl md:text-3xl text-[#0000FF] font-bold mb-1 -ml-1">Create Election</h2>
            <x-breadcrumbs previousPage="Elections" currentPage="Create Election" link="elections.view" />
        </div>

        <form action="{{ route('elections.create') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-5 create-election-for">
            @csrf

            <div class="flex flex-col gap-2 p-0 sm:px-5 sm:py-6 sm:border rounded-xl sm:gap-5">
                <label class="text-sm font-bold text-neutral-600">Election Details</label>

                <x-success_message />
                <x-error_message />

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="title" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Title
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="title" type="text" id="title"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                            placeholder="Enter election title" required>

                        @error('title')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="description"
                            class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Description
                        </label>

                        <input name="description" type="text" id="description"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                            placeholder="Enter election description">
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="start_date"
                            class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Start Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="start_date" type="datetime-local" id="start_date"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                            required>

                        @error('start_date')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="end_date" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            End Date
                            <span class="text-rose-600">*</span>
                        </label>

                        <input name="end_date" type="datetime-local" id="end_date"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                            required>
                    </div>
                </div>

                <div class="flex flex-col justify-center w-full gap-2 sm:gap-5 form-input-group md:flex-row">
                    <div class="w-full md:w-6/12">
                        <label for="type" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Location
                        </label>

                        <input name="location" type="text" id="location" placeholder="Enter election location"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0">

                        @error('location')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-6/12">
                        <label for="type" class="text-xs font-medium sm:text-sm text-neutral-500 dark:text-neutral-400">
                            Election Type
                            <span class="text-rose-600">*</span>
                        </label>

                        <select name="type" type="combo" id="type"
                            class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                            required>
                            <option>-- Select election type --</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>

                        @error('type')
                            <div class="mt-3 text-rose-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2 p-0 sm:px-5 sm:py-6 sm:border rounded-xl sm:gap-5">
                <label class="text-sm font-bold text-neutral-600">Candidates</label>

                <div class="w-full overflow-x-auto overflow-y-auto">
                    <table class="w-full candidates-table">
                        <thead>
                            <tr class="border-y">
                                <th class="px-2 py-4 text-xs text-left uppercase text-neutral-600">Candidate Name</th>
                                <th class="px-2 py-4 text-xs text-left uppercase text-neutral-600">Candidate Party</th>
                                <th class="w-12">
                                    <button type="button"
                                        class="w-fit text-white rounded bg-[#0000FF] hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-indigo-600/40 add-candidate-btn">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border-b candidates-table"></tbody>
                    </table>
                </div>
            </div>

            <div class="w-full flex justify-between items-center gap-3 my-8">
                <div class="border-b border-dashed flex-grow border-neutral-300"></div>
                <span class="text-lg font-bold uppercase text-neutral-400">Or</span>
                <div class="border-b border-dashed flex-grow border-neutral-300"></div>
            </div>

            <div class="flex flex-col gap-3 p-0 sm:px-5 sm:py-6 sm:border rounded-xl">
                <label class="text-sm font-bold text-neutral-600">Upload File (candidate data only)</label>

                <div class="w-full">
                    <p class="text-sm text-neutral-700 mb-2">Candidate data should be inputed in the format shown below:</p>
                    <img src="{{ asset('images/candidate_upload_format.png') }}" alt="file upload format image"
                        height="100" />
                </div>

                <div class="w-full">
                    <label for="imported_file" class="text-sm font-medium text-neutral-600">
                        File to upload
                    </label>

                    <input type="file" name="imported_file" id="imported_file"
                        class="w-full px-3 mt-1 flex-grow text-sm transition duration-300 border cursor-pointer border-neutral-100 rounded-lg placeholder-neutral-400 bg-neutral-100 h-10 outline-0 text-neutral-600 hover:border-neutral-400 focus:border-[#0000FF] focus:ring-0" />
                </div>
            </div>

            <div class="flex items-center justify-end w-full">
                <button type="submit"
                    class="w-full px-4 py-2.5 text-sm font-bold text-white bg-[#0000FF] rounded-md sm:w-fit hover:bg-[#0000DD] focus:bg-[#0000DD] focus:ring focus:ring-[#0000FF]/30 flex justify-center items-center gap-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Election
                </button>
            </div>
        </form>
    </div>
@endsection
