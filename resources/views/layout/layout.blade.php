@extends('layout.app')

@section('content')
    <div id="main-layout" class="flex items-start justify-between overflow-y-auto bg-neutral-100 h-modal user-dashboard">
        <x-sidebar />
        <x-mobile_menu />

        <div id="layout" class="w-full h-full pt-8 ml-0 overflow-y-auto bg-neutral-100 dark:bg-neutral-800 sm:ml-72">
            @yield('views')
        </div>
    </div>
@endsection
