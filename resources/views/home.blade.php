@extends('layout.app')
@section('no-home', 'no-home')
@section('title', 'Home')

@section('content')
    <x-hero />
    <div class="pb-20 md:px-32 px-5 flex flex-col gap-20">
        <div class="flex justify-between items-end gap-4">
            <div class="border-b flex-grow mb-4"></div>
            <h1 id="how-it-works" class="flex-grow-0 font-bold text-neutral-800 text-3xl uppercase pt-24 text-center">
                How it Works
            </h1>
            <div class="border-b flex-grow mb-4"></div>
        </div>

        <div class="px-4 flex flex-col gap-20">
            <x-how_it_works_card step="1" title="Sign Up" image="{{ asset('images/signup-illustration.svg') }}"
                direction="md:flex-row"
                description="Anim aute id magna irure qui lorem cupidatat aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo." />

            <x-how_it_works_card step="2" title="Cast Your Vote"
                image="{{ asset('images/voting-illustration.svg') }}" direction="md:flex-row-reverse"
                description="Anim aute id magna irure qui lorem cupidatat aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo." />

            <x-how_it_works_card step="3" title="See Results" image="{{ asset('images/results-illustration.svg') }}"
                direction="md:flex-row"
                description="Anim aute id magna irure qui lorem cupidatat aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo." />
        </div>
    </div>
@endsection
