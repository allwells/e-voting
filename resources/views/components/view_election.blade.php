@props(['election' => $election, 'today' => $today])

<button type="button" data-modal-toggle="medium-modal-{{ $election->id }}"
    class="text-white px-3 shadow-lg justify-center lg:w-full md:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded text-xs py-1.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
    More Details
    <svg class="w-4 h-4 ml-1 pt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
        </path>
    </svg>
</button>

<!-- View more modal -->
<div id="medium-modal-{{ $election->id }}" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto bg-neutral-900/50 backdrop-blur-sm md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-lg p-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-neutral-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-neutral-600">
                <h3 class="text-xl font-medium text-neutral-500 dark:text-neutral-500">
                    Election Details
                </h3>
                <button type="button"
                    class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-neutral-600 dark:hover:text-white"
                    data-modal-toggle="medium-modal-{{ $election->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 py-3">
                <h3 class="mb-2 text-xl font-semibold text-neutral-700 dark:text-neutral-200">
                    {{ $election->title }}
                </h3>
                <p class="text-base leading-relaxed text-neutral-500 dark:text-neutral-400">
                    {{ $election->description }}
                </p>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t rounded-b border-neutral-200 dark:border-neutral-600">
                <button data-modal-toggle="medium-modal-{{ $election->id }}" type="button"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">I
                    accept</button>
                <button data-modal-toggle="medium-modal-{{ $election->id }}" type="button"
                    class="text-neutral-500 bg-white hover:bg-neutral-100 focus:ring-4 focus:outline-none focus:ring-neutral-200 rounded-lg border border-neutral-200 text-sm font-medium px-5 py-2.5 hover:text-neutral-900 focus:z-10 dark:bg-neutral-700 dark:text-neutral-300 dark:border-neutral-500 dark:hover:text-white dark:hover:bg-neutral-600 dark:focus:ring-neutral-600">Decline</button>
            </div>
        </div>
    </div>
</div>
