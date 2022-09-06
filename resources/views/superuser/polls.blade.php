@extends('layout.layout')

@section('title', 'Polls')

@section('views')
    <div class="flex flex-col w-full gap-5 px-2 bg-white rounded-2xl sm:p-5">
        <h2 class="text-xl md:text-3xl text-[#0000FF] font-bold">Polls</h2>
        @if ($polls->count() > 0)
            @foreach ($polls as $poll)
                <x-polls_card :poll="$poll" :options="$options" :responses="$responses" />
            @endforeach
        @else
            <div class="w-full relative py-10 text-center text-sm text-neutral-600 flex justify-center items-center">
                No polls yet.
            </div>
        @endif
    </div>
@endsection
