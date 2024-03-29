@extends('layout.app')

@section('content')
    <div id="main-layout" class="flex items-start justify-between h-screen user-dashboard">
        @if (Auth::user()->role === 'super admin')
            <x-sidebar />
            <x-mobile_menu />

            <div id="layout" class="flex flex-col w-full h-full bg-neutral-100/30 py-4 px-3 sm:px-6">
                <x-header_section />

                <div class="h-full overflow-y-auto scroll-smooth scrollbar-hide">
                    @yield('views')
                </div>
            </div>
        @endif

        @if (Auth::user()->role !== 'super admin')
            <div id="layout" class="flex flex-col justify-start items-start w-full h-full bg-neutral-100/30">
                <x-nav_bar />

                @yield('views')

                <x-footer_bar />
                <x-mobile_nav />
            </div>
        @endif
    </div>
@endsection
