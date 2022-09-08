<div id="election-code-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-full md:h-full bg-black/40 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">

        <div class="relative bg-white rounded-2xl">
            <button type="button"
                class="absolute top-4 right-4 active:scale-90 text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-800 rounded-xl text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="election-code-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <div class="py-4 px-4">
                <form action="{{ route('elections.verify') }}" method="POST" class="mt-4">
                    @csrf

                    <input type="text" name="code" id="code"
                        class="text-neutral-800 px-0 text-center border-0 text-xl md:text-2xl font-bold w-full h-16 focus:ring-0 outline-0 placeholder-neutral-500"
                        placeholder="Enter election code" autocomplete="off" required>

                    <button type="submit"
                        class="w-full text-white bg-[#0000FF] hover:bg-[#0000FF] active:scale-95 font-bold rounded-xl uppercase text-xs px-6 py-3 text-center">
                        Verify Code
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
