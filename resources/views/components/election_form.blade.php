    <form id="create-election-form" class="flex flex-col items-center justify-start gap-4"
        action="{{ route('elections') }}" method="post">
        @csrf

        <div id="election-success-msg"
            class="items-center justify-between hidden w-full px-3 py-2 text-sm font-normal border rounded cursor-default border-emerald-600 text-emerald-800 bg-emerald-200 h-fit">
            <span id="election-message"></span>
            <span id="close-election-success-msg"
                class="p-1 transition duration-300 rounded-sm cursor-pointer text-emerald-500 hover:text-white hover:bg-emerald-700/90">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </span>
        </div>

        {{-- election title and description inputs --}}
        <div class="flex flex-col justify-center w-full gap-4 form-input-group md:flex-row">

            {{-- election title input --}}
            <div class="w-full md:w-6/12">
                <label for="title" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">Title
                    <span class="text-rose-500">*</span>
                </label>
                <input name="title" type="text" id="title"
                    class="block w-full px-2 text-sm transition duration-300 bg-white border rounded hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 h-11 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                    placeholder="Enter election title" required>

                @error('title')
                    <div class="mt-3 text-red-600 text-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- election description input --}}
            <div class="w-full md:w-6/12">
                <label for="description"
                    class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">Description
                </label>

                <input name="description" type="text" id="description"
                    class="block w-full px-2 text-sm transition duration-300 bg-white border rounded hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 h-11 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                    placeholder="Enter election description">
            </div>
        </div>


        {{-- election start and end dates inputs --}}
        <div class="flex flex-col justify-center w-full gap-4 form-input-group md:flex-row">

            {{-- election start date and time input --}}
            <div class="flex w-full gap-4 md:w-6/12">
                <div class="w-6/12">
                    <label for="start_date" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">Start
                        Date
                        <span class="text-rose-500">*</span>
                    </label>

                    {{-- replace type="date" with type="datetime-local" --}}
                    <input name="start_date" type="date" id="start_date"
                        class="block w-full px-2 text-sm transition duration-300 bg-white border rounded h-11 hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                        required>

                    @error('start_date')
                        <div class="mt-3 text-red-600 text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="w-6/12">
                    <label for="start_time" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">Start
                        Time
                        <span class="text-rose-500">*</span>
                    </label>
                    <input name="start_time" type="time" id="start_time"
                        class="block w-full px-2 text-sm transition duration-300 bg-white border rounded h-11 hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                        required>

                    @error('start_time')
                        <div class="mt-3 text-red-600 text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            {{-- election end date and time input --}}
            <div class="flex items-end justify-start w-full gap-4 md:w-6/12">
                <div class="w-6/12">
                    <label for="end_date" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">
                        End Date
                        <span class="text-rose-500">*</span>
                    </label>

                    {{-- replace type="date" with type="datetime-local" --}}
                    <input name="end_date" type="date" id="end_date"
                        class="block w-full px-2 text-sm transition duration-300 bg-white border rounded h-11 hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                        required>

                    @error('end_date')
                        <div class="mt-3 text-red-600 text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="w-6/12">
                    <label for="end_time" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">End Time
                        <span class="text-rose-500">*</span>
                    </label>
                    <input name="end_time" type="time" id="end_time"
                        class="block w-full px-2 text-sm transition duration-300 bg-white border rounded h-11 hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                        required>

                    @error('end_time')
                        <div class="mt-3 text-red-600 text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="flex flex-col justify-center w-full gap-4 form-input-group md:flex-row">

            {{-- election type input --}}
            <div class="w-full md:w-6/12">
                <label for="title" class="text-sm font-semibold text-neutral-700 dark:text-neutral-200">Election Type
                    <span class="text-rose-500">*</span>
                </label>
                <select name="type" type="combo" id="type"
                    class="block w-full px-2 text-sm transition duration-300 bg-white border rounded hover:border-neutral-700 border-neutral-400 text-neutral-700 focus:ring-indigo-600 focus:border-indigo-600 h-11 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600"
                    required>
                    <option>-- Select election type --</option>
                    <option value="open">Open</option>
                    <option value="close">Close</option>
                </select>

                @error('type')
                    <div class="mt-3 text-red-600 text-md">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full md:w-6/12"></div>
        </div>

        {{-- create election button --}}
        <div class="flex items-center justify-center w-full mt-2 lg:w-2/5 sm:w-3/5">
            <button type="submit"
                class="w-full font-medium text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-xl hover:bg-indigo-700 focus:border-white h-11 shadow-neutral-300 ring-1 ring-transparent dark:border-neutral-900 dark:shadow-black dark:hover:bg-indigo-700 focus:ring-indigo-600">
                Create Election
            </button>
        </div>
    </form>
