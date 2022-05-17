@extends('layout.app')

@section('content')
    <div class="mt-20 px-6 sm:px-12 h-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="py-4 w-full">
            <label for="search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-neutral-500 dark:text-neutral-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="search"
                    class="bg-neutral-50 w-full border hover:border-neutral-400 transition duration-300 dark:hover:border-neutral-400 border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block pl-10 p-2.5 dark:bg-neutral-700 dark:border-neutral-600 dark:placeholder-neutral-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                    placeholder="Search for users">
            </div>
        </div>
        {{-- <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
            <thead
                class="text-xs  overflow-x-scroll text-neutral-700 uppercase bg-neutral-50 dark:bg-neutral-700 dark:text-neutral-400">
                <tr>
                    <th scope="col" class="p-4">
                        #ID
                    </th>
                    <th scope="col" class="p-4">
                        Name
                    </th>
                    <th scope="col" class="p-4">
                        Email
                    </th>
                    <th scope="col" class="p-4">
                        Privilege
                    </th>
                    <th scope="col" class="p-4 text-center">
                        Actions
                    </th>
                </tr>
            </thead> --}}
        {{-- <tbody class="overflow-x-scroll"> --}}


        <div class="w-full bg-white rounded-md dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flow-root">
                <ul role="list">
                    @foreach ($users as $user)
                        <li
                            class="py-3 rounded-lg px-4 transition duration-300 shadow-lg bg-neutral-50 border border-neutral-200 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-700 dark:bg-neutral-900 my-3">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile.jpg') }}"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-neutral-900 truncate dark:text-white">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm text-neutral-500 truncate dark:text-neutral-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-neutral-900 dark:text-white">

                                    <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                                        data-dropdown-placement="left-start"
                                        class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:ring-neutral-500"
                                        type="button">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                            </path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="dropdownLeft"
                                        class="z-20 hidden border dark:border-neutral-500 border-neutral-300 bg-white divide-y w-fit divide-neutral-100 rounded shadow dark:bg-neutral-700">
                                        <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                                            aria-labelledby="dropdownLeftButton">
                                            <li>
                                                <a href="#"
                                                    class="block font-medium px-4 py-2 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                    View Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 font-medium rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                                    @if ($user->privilege == 'admin')
                                                        Remove Admin Privilege
                                                    @else
                                                        Make Admin
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </li>


                        {{-- <tr
                        class="bg-white dark:bg-neutral-800 my-2 dark:border-neutral-700 hover:bg-neutral-100 dark:hover:bg-neutral-900">
                        <td class="px-4 py-2">
                            {{ $user->id }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $user->name }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $user->email }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $user->privilege }}
                        </td>
                        <td class="text-center">
                            <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft"
                                data-dropdown-placement="left-start"
                                class="text-neutral-700 focus:outline-none font-medium text-sm p-1 my-1 rounded-full bg-transparent hover:bg-neutral-200 focus:ring-2 focus:ring-neutral-300 transition duration-300 text-center inline-flex items-center dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-500"
                                type="button">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownLeft"
                                class="z-20 hidden bg-white divide-y w-fit divide-neutral-100 rounded shadow dark:bg-neutral-700">
                                <ul class="p-1 text-sm text-left text-neutral-700 dark:text-neutral-200"
                                    aria-labelledby="dropdownLeftButton">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                            View Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 rounded-md hover:bg-neutral-100 dark:hover:bg-neutral-600 dark:hover:text-white">
                                            @if ($user->privilege == 'admin')
                                                Remove Admin Privilege
                                            @else
                                                Make Admin
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr> --}}
                    @endforeach
                </ul>
            </div>

        </div>
        {{-- </tbody>
        </table> --}}

        {{ $users->links() }}
    </div>
@endsection
