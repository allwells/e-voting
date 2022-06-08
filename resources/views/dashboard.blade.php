@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex items-center justify-center h-full text-2xl text-center uppercase text-neutral-400">
        Dashboard Page
    </div>
@endsection
