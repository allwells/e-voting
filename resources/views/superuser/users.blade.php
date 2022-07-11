@extends('layout.layout')

@section('title', 'Users')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')
@section('view-users-sub-tab', 'view-users-sub-tab')

@section('views')
    <div class="flex flex-col w-full gap-5 p-4 bg-white rounded-xl sm:p-5">
        <label class="text-sm font-medium text-neutral-600 sm:text-base">View Users</label>

        <x-success_message />
        <x-error_message />
        <x-warning_message />
        <x-info_message />

        <div class="flex items-center justify-center w-full">
            <x-user_search_form />
        </div>

        <div class="overflow-x-auto overflow-y-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs uppercase border-y text-neutral-700">
                        <th class="px-2 py-4 text-center">S/N</th>
                        <th class="px-2 py-4 text-left">First Name</th>
                        <th class="px-2 py-4 text-left">Last Name</th>
                        <th class="px-2 py-4 text-left">Email</th>
                        <th class="px-2 py-4 text-left">Privilege</th>

                        <th scope="col w-14">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="w-7 h-7">
                                    <g data-name="User Settings">
                                        <g data-name="&lt;Group&gt;">
                                            <path fill="none" stroke="#303c42" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M23.5,19.5v-2l-1.24-.31a4,4,0,0,0-.17-.43l.65-1.09-1.41-1.41-1.09.65a4,4,0,0,0-.43-.17L19.5,13.5h-2l-.31,1.24a4,4,0,0,0-.43.17l-1.09-.65-1.41,1.41.65,1.09a4,4,0,0,0-.17.43l-1.24.31v2l1.24.31a4,4,0,0,0,.17.43l-.65,1.09,1.41,1.41,1.09-.65a4,4,0,0,0,.43.17l.31,1.24h2l.31-1.24a4,4,0,0,0,.43-.17l1.09.65,1.41-1.41-.65-1.09a4,4,0,0,0,.17-.43Z"
                                                data-name="&lt;Path&gt;" />
                                            <circle cx="18.5" cy="18.5" r="2" fill="none"
                                                stroke="#303c42" stroke-linecap="round" stroke-linejoin="round"
                                                data-name="&lt;Path&gt;" />
                                        </g>
                                        <g data-name="&lt;Group&gt;">
                                            <circle cx="11" cy="6" r="5.5" fill="none"
                                                stroke="#303c42" stroke-linecap="round" stroke-linejoin="round"
                                                data-name="&lt;Path&gt;" />
                                            <path fill="none" stroke="#303c42" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M17.17,14.75A17.26,17.26,0,0,0,11,13.5a18.74,18.74,0,0,0-8.31,2.2A4,4,0,0,0,.5,19.27V20A1.5,1.5,0,0,0,2,21.5H14.43" />
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm border-b text-neutral-600">
                    @foreach ($users as $index => $user)
                        <x-users_table :index="$index + 1" :user="$user" />
                    @endforeach
                </tbody>
            </table>

            <div class="px-3 pt-2.5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
