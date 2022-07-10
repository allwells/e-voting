<div id="election-code-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full bg-black/40 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg">
            <button type="button"
                class="absolute top-3 right-2.5 text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-800 rounded text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="election-code-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-base font-medium text-neutral-700">Election Code Verification</h3>

                <form class="space-y-6" action="{{ route('elections.verify') }}" method="POST">
                    @csrf

                    <input type="text" name="code" id="code"
                        class="border border-transparent hover:border-neutral-300 focus:border-indigo-600 transition duration-300 text-neutral-700 text-sm rounded bg-neutral-100 w-full h-11 px-3 focus:ring-0 placeholder-neutral-500"
                        placeholder="Enter election code" required>

                    <button type="submit"
                        class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring focus:ring-indigo-600/40 font-medium rounded text-sm px-6 py-3 text-center">
                        Verify Code
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
