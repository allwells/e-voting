@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="border border-dashed border-neutral-500">
        Admin Dashboard
    </div>
@endsection
