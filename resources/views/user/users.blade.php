@extends('layout.layout')

@section('views')
    <div class="relative h-full px-3 mt-8 sm:px-16">
        <h1 class="mb-4 text-xl font-semibold cursor-default sm:text-2xl dark:text-neutral-200">
            Users
        </h1>

        <div class="w-full pb-4">
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
        <div class="overflow-x-auto">
            <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                <thead class="text-xs uppercase text-neutral-700 bg-neutral-50 dark:bg-neutral-700 dark:text-neutral-400">
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
                </thead>
                <tbody>


                    {{-- <div class="w-full bg-white rounded-md dark:bg-neutral-800 dark:border-neutral-700">
                <div class="flow-root">
                    <ul role="list"> --}}
                    @foreach ($users as $user)
                        {{-- <x-users_list :user="$user" /> --}}
                        <x-users_table :user="$user" />
                    @endforeach
                    {{-- </ul> --}}
                    {{-- </div> --}}

                    {{-- </div> --}}
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection
