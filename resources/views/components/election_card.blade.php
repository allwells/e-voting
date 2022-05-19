@props(['election' => $election, 'today' => $today])

<div
    class="w-full flex flex-col items-center bg-white rounded-lg border shadow-xl dark:border-neutral-700 dark:bg-neutral-800">
    <div class="pt-2 px-2 z-20 w-full flex justify-end items-center">
        @if (auth()->user()->privilege == 'superuser' || auth()->user()->privilege == 'admin')
            <button type="button" id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                data-dropdown-placement="left-start"
                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                    </path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownLeft" aria-labelledby="dropdownLeftButton"
                class="z-30 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-44 divide-neutral-100 rounded-md shadow-lg dark:bg-neutral-700">
                <ul class="text-sm text-left text-neutral-700 dark:text-neutral-200">

                    {{-- Edit election menu button --}}
                    <li class="p-1.5">
                        <button
                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit
                        </button>
                    </li>

                    {{-- Close election menu button --}}
                    <li class="pb-1.5 px-1.5">
                        <a href="{{ route('elections') }}"
                            class="flex justify-items-start items-center transition duration-300 w-full p-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z">
                                </path>
                            </svg>
                            Close Election
                        </a>
                    </li>

                    {{-- Delete election menu button --}}
                    <li class="p-1.5 border-t dark:border-neutral-600">
                        <form action="{{ route('elections') }}" method="post" class="w-full">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="border-0 transition duration-300 flex justify-start items-center w-full p-2 font-medium rounded-md text-red-500 hover:bg-red-100 dark:hover:text-red-300 dark:hover:bg-red-700">
                                <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>

    <div
        class="@if (auth() && auth()->user()->privilege != 'user') -mt-7 @else pt-4 @endif flex flex-col justify-between items-start px-4 sm:px-6 leading-normal w-full">
        {{-- Election title --}}
        <h5 class="mb-2 text-lg sm:text-2xl font-bold text-neutral-900 dark:text-white">
            {{ $election->title }}
        </h5>

        {{-- Election description --}}
        <p
            class="text-left font-light text-sm sm:text-lg text-neutral-700 dark:text-neutral-400 line-clamp-3 md:line-clamp-2 lg:line-clamp-none">
            {{ $election->description }}
        </p>
    </div>

    <div class="w-full flex flex-col sm:flex-row justify-between items-end gap-3 px-4 sm:px-6 py-6">
        <div
            class="w-full flex flex-col sm:flex-row justify-between sm:justify-start items-start sm:items-center sm:w-fit flex-grow gap-3">
            {{-- election start date --}}
            <div class="flex flex-col justify-start gap-2w-fit">
                <label class="text-neutral-700 text-xs font-medium items-center cursor-default dark:text-neutral-300">
                    From:
                </label>
                <span
                    class="bg-neutral-100 text-neutral-700 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-sm cursor-default dark:bg-neutral-700 dark:text-neutral-300">
                    <svg class="w-4 h-4 mr-1 cursor-default" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{-- date --}}
                    {{ substr($election->start_date, 0, 10) }}

                    {{-- time --}}
                    <svg class="w-4 h-4 ml-2 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ substr($election->start_date, 10, 6) }} UTC
                </span>
            </div>

            {{-- election end date --}}
            <div class="flex flex-col justify-start gap-2w-fit">
                <label class="text-neutral-700 text-xs font-medium items-center cursor-default dark:text-neutral-300">
                    To:
                </label>
                <span
                    class="bg-neutral-100 text-neutral-700 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-sm cursor-default dark:bg-neutral-700 dark:text-neutral-300">
                    <svg class="w-4 h-4 mr-1 cursor-default" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{-- date --}}
                    {{ substr($election->end_date, 0, 10) }}

                    {{-- time --}}
                    <svg class="w-4 h-4 ml-2 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ substr($election->end_date, 10, 6) }} UTC
                </span>
            </div>
        </div>

        <div class="w-full sm:w-fit flex flex-col sm:flex-row justify-end items-end gap-2 sm:gap-3">
            @if ($today->gt($election->start_date) && $today->gt($election->end_date))
                <a href="{{ route('elections') }}"
                    class="text-white px-3 shadow-lg justify-center sm:w-fit w-full font-semibold flex bg-indigo-700 border border-indigo-500 transition duration-300 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 rounded text-xs py-1.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    View Results
                </a>
            @endif

            @if ((auth() && auth()->user()->privilege == 'superuser') || (auth() && auth()->user()->privilege == 'admin'))
                @if (!($today->gt($election->start_date) && $today->gt($election->end_date)))
                    <x-add_candidate :election="$election" />
                @endif
            @endif

            <x-view_election :election="$election" :today="$today" />
        </div>
    </div>
</div>
