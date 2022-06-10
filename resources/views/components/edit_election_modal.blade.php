@props(['election' => $election])

<button type="button" data-modal-toggle="authentication-modal-{{ $election->id }}" title="Edit this election"
    class="block p-2 font-medium text-left transition duration-300 w-fit hover:bg-neutral-100 dark:hover:bg-neutral-700/50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
        </path>
    </svg>
</button>

<div id="authentication-modal-{{ $election->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-neutral-900/50 backdrop-blur-sm md:inset-0">
    <div class="relative w-full h-full max-w-3xl p-4 md:h-auto">

        <div class="relative bg-white shadow dark:bg-neutral-800">
            <button type="button"
                class="absolute top-3 right-2.5 text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-neutral-800 dark:hover:text-white"
                data-modal-toggle="authentication-modal-{{ $election->id }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-neutral-900 dark:text-white">Edit election details</h3>
                <form id="update-election-form" class="flex flex-col items-center justify-start gap-4 mt-12"
                    action="{{ route('elections.edit', $election->id) }}" method="post">
                    @csrf

                    <div id="election-success-msg"
                        class="items-center justify-between hidden w-full px-3 py-3 font-normal text-left border-2 border-white cursor-default dark:border-neutral-900 text-md ring-1 ring-emerald-300 text-emerald-800 bg-emerald-200 h-fit">
                        <span id="election-message"></span>
                        <span id="close-election-success-msg"
                            class="p-1 text-white transition duration-300 cursor-pointer bg-emerald-600/60 hover:bg-emerald-700/90">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </span>
                    </div>

                    {{-- election title and description inputs --}}
                    <div class="flex flex-col justify-center w-full gap-4 form-input-group md:flex-row">

                        {{-- election title input --}}
                        <div class="w-full md:w-6/12">
                            <label for="title" class="text-sm font-semibold text-gray-700 dark:text-neutral-200">Title
                                <span class="text-rose-500">*</span>
                            </label>
                            <input name="title" type="text" id="title"
                                class="bg-white border-4 hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-base focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Enter election title" value="{{ $election->title }}" required>

                            @error('title')
                                <div class="mt-3 text-red-600 text-md">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- election description input --}}
                        <div class="w-full md:w-6/12">
                            <label for="description"
                                class="text-sm font-semibold text-gray-700 dark:text-neutral-200">Description
                            </label>

                            <input name="description" type="text" id="description"
                                class="bg-white border-4 hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-base focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Enter election description" value="{{ $election->description }}">
                        </div>
                    </div>


                    {{-- election start and end dates inputs --}}
                    <div class="flex flex-col justify-center w-full gap-4 mt-6 form-input-group md:flex-row">

                        {{-- election start date and time input --}}
                        <div class="flex w-full gap-4 md:w-6/12">
                            <div class="w-full">
                                <label for="start_date"
                                    class="text-sm font-semibold text-gray-700 dark:text-neutral-200">Start Date
                                    <span class="text-rose-500">*</span>
                                </label>

                                {{-- replace type="date" with type="datetime-local" --}}
                                <input name="start_date" type="date" id="start_date"
                                    class="block w-full p-3 text-sm transition duration-300 bg-white border-4 hover:border-neutral-500 border-neutral-300 text-neutral-700 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                    value="{{ substr($election->start_date, 0, 10) }}" required>

                                @error('start_date')
                                    <div class="mt-3 text-red-600 text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="w-6/12">
                                <label for="start_time"
                                    class="text-sm font-semibold text-gray-700 dark:text-neutral-200">Start Time
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input name="start_time" type="time" id="start_time"
                                    class="block w-full p-3 text-sm transition duration-300 bg-white border-4 hover:border-neutral-500 border-neutral-300 text-neutral-700 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                    value="{{ date('H:i', strtotime(substr($election->start_date, 10, 6))) }}"
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
                                <label for="end_date"
                                    class="text-sm font-semibold text-gray-700 dark:text-neutral-200">End Date
                                    <span class="text-rose-500">*</span>
                                </label>

                                {{-- replace type="date" with type="datetime-local" --}}
                                <input name="end_date" type="date" id="end_date"
                                    class="block w-full p-3 text-sm transition duration-300 bg-white border-4 hover:border-neutral-500 border-neutral-300 text-neutral-700 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                    value="{{ substr($election->end_date, 0, 10) }}" required>

                                @error('end_date')
                                    <div class="mt-3 text-red-600 text-md">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="w-6/12">
                                <label for="end_time"
                                    class="text-sm font-semibold text-gray-700 dark:text-neutral-200">End Time
                                    <span class="text-rose-500">*</span>
                                </label>
                                <input name="end_time" type="time" id="end_time"
                                    class="block w-full p-3 text-sm transition duration-300 bg-white border-4 hover:border-neutral-500 border-neutral-300 text-neutral-700 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-400 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                    value="{{ date('H:i', strtotime(substr($election->end_date, 10, 6))) }}"
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
                            <label for="title"
                                class="text-sm font-semibold text-gray-700 dark:text-neutral-200">Election Type
                                <span class="text-rose-500">*</span>
                            </label>
                            <select name="type" type="combo" id="type"
                                class="bg-white border-4 hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-700 text-base focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-500 dark:placeholder-neutral-300 dark:text-neutral-100 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                required>
                                <option>-- Select election type --</option>
                                <option @if ($election->type == 'open') selected @endif value="open">Open</option>
                                <option @if ($election->type == 'close') selected @endif value="close">Close</option>
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
                    <div class="flex items-center justify-center w-full mt-5 border lg:w-2/5 sm:w-3/5">
                        <button type="submit"
                            class="w-full h-12 font-semibold text-white transition duration-300 bg-indigo-600 border-2 border-white shadow-xl signup-submit-btn ring-1 dark:hover:shadow-neutral-900 dark:border-neutral-900 dark:hover:bg-indigo-700 ring-indigo-600 hover:shadow-indigo-300 active:shadow-none">
                            Update Election
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
