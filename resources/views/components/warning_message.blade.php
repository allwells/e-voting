@if (\Session::has('warn'))
    <div id="alert-2" class="flex w-full p-4 mt-3 mb-4 bg-yellow-200 rounded-md dark:bg-yellow-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-yellow-700 dark:text-yellow-800" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd"></path>
        </svg>

        <div class="ml-2 text-sm font-normal tracking-wide text-yellow-700 dark:text-yellow-800">
            {{ \Session::get('warn') }}
        </div>

        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-yellow-500 rounded hover:text-yellow-700 focus:ring-2 focus:text-yellow-700 focus:ring-yellow-400 p-1.5 hover:bg-yellow-100 inline-flex h-8 w-8 dark:bg-yellow-200 dark:text-yellow-600 dark:hover:bg-yellow-300"
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
