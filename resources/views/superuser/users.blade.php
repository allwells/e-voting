@extends('layout.layout')

@section('title', 'Users')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')

@section('views')
    <div class="flex flex-col items-start gap-8 justify-start h-full">
        {{-- <div class="border w-full flex justify-center items-center">
            <x-user_search_form />
        </div> --}}

        <div class="w-full px-3 pb-3 bg-white overflow-y-auto overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-neutral-100">
                        <th class="text-neutral-700 text-sm uppercase px-2 text-center w-8 border-r border-neutral-100">ID
                        </th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-left">First Name</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-left">Last Name</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-left">Email</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-left">Privilege</th>
                        <th class="text-neutral-700 text-sm uppercase px-2 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-b border-neutral-100">
                    @foreach ($users as $user)
                        <x-users_table :user="$user" />
                    @endforeach
                </tbody>
            </table>

            <div class="px-3 pt-2.5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
