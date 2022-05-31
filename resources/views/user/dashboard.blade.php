@extends('layout.layout')

@section('views')
    <div class="flex flex-col flex-wrap gap-4 p-6 sm:px-6 sm:py-8 sm:flex-row">
        @if ((auth() && auth()->user()->privilege == 'superuser') || (auth() && auth()->user()->privilege == 'admin'))
            <div
                class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
                <h5
                    class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                    Total Users
                </h5>
                <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $users->count() }}</span>
            </div>

            <div
                class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
                <h5
                    class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                    Users
                </h5>
                <span
                    class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $users->count() - $admins->count() }}</span>
            </div>

            @if (auth() && auth()->user()->privilege == 'superuser')
                <div
                    class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
                    <h5
                        class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                        Admins
                    </h5>
                    <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $admins->count() }}</span>
                </div>
            @endif
        @endif

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Total Elections
            </h5>
            <span
                class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $upcoming->count() + $opened->count() + $closed->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Upcoming Elections
            </h5>
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $upcoming->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Opened Elections
            </h5>
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $opened->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Closed Elections
            </h5>
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $closed->count() }}</span>
        </div>
    </div>

    {{-- upcoming elections --}}
    <h1 class="mx-6 mt-6 mb-2 text-lg font-semibold cursor-default md:text-2xl dark:text-neutral-200">
        Upcoming Election(s)
    </h1>

    @if ($upcoming->count() > 2)
        <div class="flex justify-end items-center mx-6 mb-4">
            <span>
                <a href="/elections#accordion-flush-heading-1" class="hover:underline text-indigo-500 text-right">
                    See more
                </a>
            </span>
        </div>
    @endif

    @if ($upcoming_elections->count() > 0)
        <div
            class="flex flex-col gap-4 p-2 mx-6 mb-6 border border-dashed border-neutral-400 dark:border-neutral-700 lg:flex-row">
            @foreach ($upcoming_elections as $election)
                <div class="lg:w-6/12">
                    <x-election_card :election="$election" :today="$today" />
                </div>
            @endforeach
        </div>
    @else
        <div
            class="flex items-center justify-center h-32 mx-6 mb-6 text-center border border-dashed text-neutral-400 border-neutral-300 dark:border-neutral-700">
            No upcoming elections.
        </div>
    @endif

    {{-- Opened elections --}}
    <h1 class="mx-6 mt-16 mb-2 text-lg font-semibold cursor-default md:text-2xl dark:text-neutral-200">
        Opened Election(s)
    </h1>

    @if ($opened->count() > 2)
        <div class="flex justify-end items-center mx-6 mb-4">
            <span>
                <a href="/elections#accordion-flush-heading-2" class="hover:underline text-indigo-500 text-right">
                    See more
                </a>
            </span>
        </div>
    @endif

    @if ($opened_elections->count() > 0)
        <div
            class="flex flex-col gap-4 p-2 mx-6 mb-6 border border-dashed border-neutral-400 dark:border-neutral-700 lg:flex-row">
            @foreach ($opened_elections as $election)
                <div class="lg:w-6/12">
                    <x-election_card :election="$election" :today="$today" />
                </div>
            @endforeach
        </div>
    @else
        <div
            class="flex items-center justify-center h-32 mx-6 mb-6 text-center border border-dashed text-neutral-400 border-neutral-300 dark:border-neutral-700">
            No opened elections.
            <a href="{{ route('elections') }}" class="ml-1 text-blue-600 underline">Create new
                election</a>
        </div>
    @endif
@endsection
