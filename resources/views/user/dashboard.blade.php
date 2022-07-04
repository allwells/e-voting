@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start justify-start h-full pr-5">
        User Dashboard
    </div>
@endsection
