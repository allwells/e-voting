@extends('layout.layout')

@section('views')
    <div class="flex items-center justify-center px-3 py-10 h-fit lg:px-40">
        <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
            <h2
                class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                Add Candidates
            </h2>
            <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                <x-candidate_form :elections="$elections" />
            </div>
        </div>
    </div>
@endsection
