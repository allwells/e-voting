@extends('layout.app')

@section('content')
    <div class="flex items-start justify-between overflow-y-auto bg-neutral-100 h-modal user-dashboard">
        <x-sidebar />
        <x-mobile_menu />

        <div id="layout" class="bg-neutral-100 w-full pt-8 ml-0 overflow-y-auto h-full sm:ml-72">
            @yield('views')
        </div>
    </div>
@endsection
