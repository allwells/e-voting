<form class="flex items-center w-full">
    <label for="default-search"
        class="mb-2 text-sm font-medium text-neutral-900 sr-only dark:text-neutral-300">Search</label>
    <div class="relative w-full flex justify-between items-center">

        <input type="search" id="default-search"
            class="block w-full pl-4 placeholder-neutral-400 text-sm text-neutral-600 h-12 bg-neutral-100 border border-neutral-100 hover:border-neutral-300 focus:border-indigo-500 rounded-md transition duration-300 focus:ring-0 outline-0"
            placeholder="Search..." required>

        <button type="submit"
            class="absolute right-1.5 bg-neutral-100 hover:bg-neutral-200 border border-transparent transition duration-300 outline-0 text-neutral-600 focus:border-indigo-500 focus:bg-neutral-200 rounded-md p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>
</form>
