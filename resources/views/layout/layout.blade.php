@extends('layout.app')

@section('content')
    <div class="flex items-start justify-between mt-16 overflow-auto h-modal user-dashboard">
        <x-sidebar />

        <div id="layout" class="w-full pb-16 ml-0 h-fit sm:ml-56">
            @yield('views')
        </div>
    </div>
@endsection
