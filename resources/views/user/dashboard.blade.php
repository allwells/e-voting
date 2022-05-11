@extends('layout.app')

@section('content')
    <div class="user-dashboard flex justify-center w-full py-5 text-2xl text-center border rounded text-bold">
        Dashboard
        <br>
        Name - {{ $user->name }}
        <br>
        Privilege - {{ $user->privilege }}
    </div>
@endsection
