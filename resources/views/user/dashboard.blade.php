@extends('layout.layout')

@section('views')
    <div class="flex flex-col flex-wrap gap-4 p-6 sm:px-6 sm:py-8 sm:flex-row">
        @if ((auth() && auth()->user()->privilege == 'superuser') || (auth() && auth()->user()->privilege == 'admin'))
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
                    Total Users
                </h5>
                <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $users->count() }}</span>
            </div>
        @endif

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Upcoming Elections
            </h5>
            <span
                class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $upcoming_elections->count() }}</span>
        </div>

        <div
            class="flex flex-col items-center justify-center w-full px-6 py-6 bg-white border shadow-xl md:w-2/6 rounded-xl border-neutral-200 dark:bg-neutral-800 dark:border-neutral-700">
            <h5
                class="mb-2 text-xs font-normal tracking-tight text-center uppercase cursor-default md:text-sm text-neutral-700 dark:text-neutral-50">
                Opened Elections
            </h5>
            <span class="text-3xl font-bold cursor-default dark:text-neutral-500">{{ $opened_elections->count() }}</span>
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
@endsection
