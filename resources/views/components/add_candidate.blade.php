@props(['election' => $election])

<button type="button" data-modal-toggle="authentication-modal-{{ $election->id }}"
    class="text-white px-3 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded text-xs py-1.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
    </svg>
    Add Candidate
</button>

<div id="authentication-modal-{{ $election->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full h-full overflow-x-hidden overflow-y-auto bg-neutral-900/50 backdrop-blur-sm md:inset-0">
    <div class="relative w-full h-full max-w-md p-4 md:h-auto">

        <div class="relative bg-white rounded-lg shadow dark:bg-neutral-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-neutral-800 dark:hover:text-white"
                data-modal-toggle="authentication-modal-{{ $election->id }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-neutral-900 dark:text-white">Add election candidate</h3>
                <form class="space-y-6" action="{{ route('elections.candidate', $election->id) }}" method="post">
                    @csrf

                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input name="name" type="text" id="name"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Candidate's name" required>

                        @error('name')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="party"
                            class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Party
                        </label>
                        <input name="party" type="text" id="party"
                            class="bg-neutral-50 border hover:border-neutral-500 transition duration-300 border-neutral-300 text-neutral-900 text-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:hover:border-neutral-400 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Candidate's party" required>

                        @error('party')
                            <div class="mt-3 text-red-600 text-md">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="image"
                            class="block mb-2 text-sm font-normal text-neutral-700 dark:text-neutral-300">
                            Candidate's Image
                        </label>

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full transition duration-300 border-2 border-dashed rounded-lg cursor-pointer h-44 bg-neutral-50 hover:border-neutral-500 border-neutral-300 dark:hover:bg-bray-800 dark:bg-neutral-700 hover:bg-neutral-100 dark:border-neutral-600 dark:hover:border-neutral-400 dark:hover:bg-neutral-600">

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

                    <button type="submit"
                        class="w-full flex justify-center items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Candidate
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
