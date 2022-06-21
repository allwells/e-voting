@extends('layout.app')

@section('content')
    <div id="main-layout" class="flex items-start justify-between h-screen user-dashboard">
        <x-sidebar />
        <x-mobile_menu />

        <div id="layout" class="flex flex-col w-full h-full bg-neutral-100/30 py-4 px-3 sm:px-6">
            <x-header_section />

            <div class="h-full overflow-y-auto">
                @yield('views')
            </div>
        </div>
    </div>
@endsection
