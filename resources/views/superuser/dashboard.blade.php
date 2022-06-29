@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start justify-start h-full pr-5">
        <div class="flex lg:flex-nowrap flex-wrap items-center gap-4 justify-stretch w-full">
            <x-analysis_card :data="$total_admins" title="Admins" icon="fas fa-user-tie" />
            <x-analysis_card :data="$total_users" title="Total Users" icon="fas fa-users" />
            <x-analysis_card :data="$elections" title="Elections" icon="fas fa-box" />
        </div>

        <div class="flex justify-end items-center w-full mt-8">
            <span class="text-sm text-neutral-500 hover:text-neutral-800">
                <a href="{{ route('users') }}" class="underline">See all</a>
            </span>
        </div>

        <div class="w-full flex gap-4">
            <div class="w-full sm:w-6/12">
                <label class="text-neutral-600 font-medium text-base">Admins</label>

                <table class="w-full mt-2 bg-white border">
                    <thead>
                        <tr class="border-b text-neutral-700 text-xs uppercase">
                            <th class="py-4 px-2 text-center">S/N</th>
                            <th class="py-4 px-2 text-left">Name</th>
                            <th class="py-4 px-2 text-left">Email</th>
                            <th class="py-4 px-2 text-left">Privilege</th>

                            <th scope="col" class="px-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="pl-1">
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
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-b text-neutral-600 text-sm">
                        @foreach ($admins as $index => $admin)
                            <x-dashboard_users_table :index="$index + 1" :user="$admin" />
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full sm:w-6/12">
                <label class="text-neutral-600 font-medium text-base">Users</label>
                <table class="w-full mt-2 bg-white border">
                    <thead>
                        <tr class="border-b text-neutral-700 text-xs uppercase">
                            <th class="py-4 px-2 text-center">S/N</th>
                            <th class="py-4 px-2 text-left">Name</th>
                            <th class="py-4 px-2 text-left">Email</th>
                            <th class="py-4 px-2 text-left">Privilege</th>

                            <th scope="col" class="px-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="pl-1">
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
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-b text-neutral-600 text-sm">
                        @foreach ($users as $index => $users)
                            <x-dashboard_users_table :index="$index + 1" :user="$users" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
