@extends('layout.layout')

@section('title', 'settings');
@section('settings-tab', auth()->user()->theme == 'dark' ? 'active-dark-settings' : 'active-settings')

@section('views')
    <div class="flex items-center justify-center h-full text-2xl text-center uppercase text-neutral-400">
        Settings Page
    </div>
@endsection
