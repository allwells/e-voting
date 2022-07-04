@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start justify-start h-full pr-5">
        @if (auth()->user()->privilege === 'admin')
            {{ view('admin.dashboard', ['elections' => $elections, 'totalAdmins' => $totalAdmins, 'totalUsers' => $totalUsers]) }}
        @else
            {{ view('user.dashboard') }}
        @endif
    </div>
@endsection
