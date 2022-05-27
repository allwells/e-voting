@extends('layout.app')

@section('content')
    <div class="flex items-start justify-between pt-16 overflow-y-auto h-modal user-dashboard">
        <x-sidebar />

        <div id="layout" class="w-full pt-1.5 ml-0 overflow-y-auto sm:mb-0 h-fit sm:ml-56">
            @yield('views')
        </div>
    </div>
@endsection
