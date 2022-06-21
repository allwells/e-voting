@extends('layout.layout')

@section('title', 'Users')
@section('users-tab', auth()->user()->theme == 'dark' ? 'active-dark-users' : 'active-users')

@section('views')
    <div class="w-full bg-white flex flex-col gap-5 rounded-xl p-4 sm:p-5">
        <label class="text-neutral-600 font-medium text-sm sm:text-base">Users</label>
        {{-- <div class="border w-full flex justify-center items-center">
            <x-user_search_form />
        </div> --}}

        <div class="overflow-y-auto overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-y text-neutral-700 text-xs uppercase">
                        <th class="px-2 text-center">S/N</th>
                        <th class="p-4 text-left">First Name</th>
                        <th class="py-4 pl-4 text-left">Last Name</th>
                        <th class="py-4 pl-4 text-left">Email</th>
                        <th class="py-4 pl-4 text-left">Privilege</th>

                        <th scope="col" class="px-1 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="border-b text-neutral-600 text-sm">
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
