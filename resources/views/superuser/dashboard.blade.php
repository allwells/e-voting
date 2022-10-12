@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', Auth::user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start justify-start h-full">
        <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-3">
            <x-analysis_card :data="$totalAdmins" title="Admins" icon="fas fa-user-tie" />
            <x-analysis_card :data="$totalUsers" title="Total Users" icon="fas fa-users" />
            <x-analysis_card :data="$totalElections" title="Elections" icon="fas fa-box" />
        </div>

        <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-2">
            <div class="w-full h-full overflow-x-auto">
                <div class="flex items-center justify-between w-full mt-8">
                    <label class="text-base font-bold text-neutral-700">Users</label>
                    <a href="{{ route('users') }}"
                        class="flex items-center justify-center text-xs font-bold uppercase hover:underline text-neutral-500 hover:text-neutral-900">
                        See all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full mt-2 bg-white border">
                        <thead>
                            <tr class="text-xs uppercase border-b text-neutral-700">
                                <th class="py-4 text-center w-14">S/N</th>
                                <th class="px-2 py-4 text-left">Name</th>
                                <th class="px-2 py-4 text-left">Email</th>
                                <th class="px-2 py-4 text-center">Role</th>

                                <th scope="col" class="px-1 text-center w-14">
                                    <span class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="pl-1 h-7 w-7">
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
                        @if ($users->count() > 0)
                            <tbody class="text-sm border-b text-neutral-600">
                                @foreach ($users as $index => $user)
                                    <x-dashboard_users_table :index="$index + 1" :user="$user" />
                                @endforeach
                            </tbody>
                        @else
                            <tr>
                                <td colspan="6" class="py-10 text-center">
                                    <span class="text-base tracking-wider text-neutral-500">No users.</span>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="w-full h-full overflow-x-auto">
                <div class="flex items-center justify-between w-full mt-8">
                    <label class="text-base font-bold text-neutral-700">Results</label>
                    <a href="{{ route('results') }}"
                        class="flex items-center justify-center text-xs font-bold uppercase hover:underline text-neutral-500 hover:text-neutral-900">
                        See all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full mt-2 bg-white border">
                        <thead>
                            <tr class="text-xs uppercase border-b text-neutral-700">
                                <th class="px-2 py-4 text-center w-14">S/N</th>
                                <th class="px-2 py-4 text-left">Election Title</th>
                                <th class="w-24 px-2 py-4 text-center">Candidates</th>
                                <th class="w-16 px-2 py-4 text-center">Votes</th>
                                <th class="w-16 px-2 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm border-b text-neutral-600">
                            @if ($results->count() > 0)
                                @foreach ($results as $index => $result)
                                    <x-dashboard_results_table :index="$index + 1" :result="$result" :hasPrivacy="false"
                                        :hasDescription="false" />
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-10 text-center">
                                        <span class="text-base tracking-wider text-neutral-500">No results.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-2">
            <div class="w-full h-full overflow-x-auto">
                <div class="flex items-center justify-between w-full mt-8">
                    <label class="text-base font-bold text-neutral-700">Elections</label>
                    <a href="{{ route('elections.view') }}"
                        class="flex items-center justify-center text-xs font-bold uppercase hover:underline text-neutral-500 hover:text-neutral-900">
                        See all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="mt-2 overflow-x-auto">
                    <table class="w-full bg-white border">
                        <thead>
                            <tr class="text-xs uppercase border-b text-neutral-700">
                                <th class="px-2 py-4 text-center w-14">S/N</th>
                                <th class="py-4 pl-3 text-left">Election Title</th>
                                <th class="w-16 py-4 text-center">Privacy</th>
                                <th class="w-16 py-4 text-center">Status</th>
                                <th class="w-16 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm border-b text-neutral-600">
                            @if ($elections->count() > 0)
                                @foreach ($elections as $index => $election)
                                    <x-election_table :index="$index + 1" :election="$election" :today="$today"
                                        :hasDescription="false" />
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-10 text-center">
                                        <span class="text-base tracking-wider text-neutral-500">No elections.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-full h-full overflow-x-auto">
                <div class="flex items-center justify-between w-full mt-8">
                    <label class="text-base font-bold text-neutral-700">Polls</label>
                    <a href="{{ route('polls.view') }}"
                        class="flex items-center justify-center text-xs font-bold uppercase hover:underline text-neutral-500 hover:text-neutral-900">
                        See all
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="mt-2 overflow-x-auto">
                    <table class="w-full bg-white border">
                        <thead>
                            <tr class="text-xs uppercase border-b text-neutral-700">
                                <th class="px-2 py-4 text-center w-14">S/N</th>
                                <th class="py-4 pl-3 text-left">Title</th>
                                <th class="w-16 py-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm border-b text-neutral-600">
                            @if ($polls->count() > 0)
                                @foreach ($polls as $index => $poll)
                                    <x-polls_table :index="$index + 1" :poll="$poll" :today="$today" />
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-10 text-center">
                                        <span class="text-base tracking-wider text-neutral-500">No elections.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
