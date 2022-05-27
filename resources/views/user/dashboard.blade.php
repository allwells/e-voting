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
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $elections->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Upcoming Elections
            </h5>
            <span
                class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $upcoming_elections_all->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Opened Elections
            </h5>
            <span
                class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $opened_elections_all->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Closed Elections
            </h5>
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $closed_elections->count() }}</span>
        </div>
    </div>

    {{-- upcoming elections --}}
    <h1 class="mx-6 mt-6 mb-4 text-lg font-semibold cursor-default md:text-2xl dark:text-neutral-200">
        Upcoming Election(s)
    </h1>
    @if ($upcoming_elections->count() > 0)
        <div class="flex flex-col gap-6 p-2 mx-6 mb-6 border border-dashed border-neutral-400 dark:border-neutral-700">
            @foreach ($upcoming_elections as $election)
                <x-election_card :election="$election" :today="$today" />
            @endforeach
            <div @if (auth()->user()->mode === 'dark') id="pagination-dark" @endif class="mt-2">
                {{ $upcoming_elections->links() }}
            </div>
        </div>
    @else
        <div
            class="flex items-center justify-center h-32 mx-6 mb-6 text-center border border-dashed text-neutral-400 border-neutral-300 dark:border-neutral-700">
            No upcoming elections.
        </div>
    @endif

    {{-- Opened elections --}}
    <h1 class="mx-6 mt-6 mb-4 text-lg font-semibold cursor-default md:text-2xl dark:text-neutral-200">
        Opened Election(s)
    </h1>

    @if ($opened_elections->count() > 0)
        <div class="flex flex-col gap-6 p-2 mx-6 mb-6 border border-dashed border-neutral-400 dark:border-neutral-700">
            @foreach ($opened_elections as $election)
                <x-election_card :election="$election" :today="$today" />
            @endforeach
            <div @if (auth()->user()->mode === 'dark') id="pagination-dark" @endif class="mt-2">
                {{ $opened_elections->links() }}
            </div>
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
