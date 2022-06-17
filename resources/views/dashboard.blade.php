@extends('layout.layout')

@section('title', 'Dashboard')
@section('dashboard-tab', auth()->user()->theme == 'dark' ? 'active-dark-dashboard' : 'active-dashboard')

@section('views')
    <div class="flex flex-col items-start gap-8 justify-start h-full">
        <div class="flex lg:flex-nowrap flex-wrap items-center gap-4 justify-stretch w-full">
            <x-analysis_card :data="$users" title="Users" icon="fas fa-users" />
            <x-analysis_card :data="$admins" title="Admins" icon="fas fa-user-tie" />
            <x-analysis_card :data="$elections" title="Elections" icon="fas fa-box" />
        </div>

        <div class="border w-full">

        </div>
    </div>
@endsection
