<form id="add-candidates-form" class="flex flex-col items-center justify-start mt-8 space-y-8"
    action="{{ route('candidates') }}" method="POST">
    @csrf

    <div id="candidate-success-msg"
        class="items-center justify-between hidden w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default text-md ring-1 ring-emerald-300 text-emerald-800 bg-emerald-200 h-fit">
        <span id="candidate-message"></span>
        <span id="close-candidate-success-msg"
            class="p-1 text-white transition duration-300 rounded-sm cursor-pointer bg-emerald-600/60 hover:bg-emerald-700/90">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </span>
    </div>

    <div class="flex flex-col w-full gap-4">
        <div class="flex flex-col gap-4 md:flex-row">
            {{-- name input field --}}
            <div class="w-full md:w-6/12">
                <label for="name" class="font-semibold text-gray-700">Name
                    <span class="text-rose-500">*</span>
                </label>
                <input id="name" name="name" type="text"
                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                    placeholder="Enter candidate's full name" value="{{ old('name') }}">

                <span id='name-error' class="text-red-600 text-md error-text"></span>
            </div>

            {{-- party field --}}
            <div class="w-full md:w-6/12">
                <label for="party" class="font-semibold text-gray-700">Party
                    <span class="text-rose-500">*</span>
                </label>
                <input id="party" name="party" type="text"
                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                    placeholder="Enter candidate's party" value="{{ old('party') }}">

                <span id='party-error' class="text-red-600 text-md error-text"></span>
            </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row">
            {{-- election field --}}
            <div class="w-full md:w-6/12">
                <label for="election_id" class="font-semibold text-gray-700">Election
                    <span class="text-rose-500">*</span>
                </label>
                <select id="election_id" name="election_id" type="text"
                    class="relative block w-full px-3 py-2 mt-1 text-base text-gray-700 duration-300 border-4 border-gray-200 h-14 hover:border-gray-500 focus:outline-none focus:ring-indigo-600 focus:border-indigo-600 focus:z-10"
                    value="{{ old('election_id') }}">
                    <option>-- Select election --</option>
                    @foreach ($elections as $election)
                        <option value="{{ $election->id }}">{{ $election->title }}</option>
                    @endforeach
                </select>

                <span id='election_id-error' class="text-red-600 text-md error-text"></span>
            </div>

            {{-- image field --}}
            <div class="w-full md:w-6/12">
                <label for="email" class="font-semibold text-gray-700">
                    Image
                </label>

                <div class="flex items-center justify-center w-full mt-1">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full transition duration-300 border-4 border-dashed cursor-pointer h-44 bg-neutral-50 hover:border-neutral-500 border-neutral-300 dark:bg-neutral-700 hover:bg-neutral-100 dark:border-neutral-600 dark:hover:border-indigo-600 dark:hover:bg-neutral-600">

                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-neutral-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-center text-neutral-500 dark:text-neutral-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-center text-neutral-500 dark:text-neutral-400">
                                SVG, PNG or JPG (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" name="image" type="file" class="hidden">
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- add candidate button --}}
    <div class="flex items-center justify-center w-full border lg:w-2/5 sm:w-3/5">
        <button type="submit"
            class="w-full h-12 font-semibold text-white transition duration-300 bg-indigo-600 border-2 border-white shadow-xl signup-submit-btn ring-1 ring-indigo-600 hover:shadow-indigo-300 active:shadow-none">
            Add Candidate
        </button>
    </div>
</form>
