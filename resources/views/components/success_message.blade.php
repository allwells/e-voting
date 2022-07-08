@if (\Session::has('success'))
    <div id="alert-2" class="flex w-full p-4 mt-3 mb-4 rounded-md bg-emerald-200 dark:bg-emerald-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-emerald-700 dark:text-emerald-800" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd"></path>
        </svg>

        <div class="ml-2 text-sm font-normal tracking-wide text-emerald-700 dark:text-emerald-800">
            {{ \Session::get('success') }}
        </div>

        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-emerald-500 rounded hover:text-emerald-700 focus:ring-2 focus:text-emerald-700 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex h-8 w-8 dark:bg-emerald-200 dark:text-emerald-600 dark:hover:bg-emerald-300"
            data-dismiss-target="#alert-2" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
@endif
