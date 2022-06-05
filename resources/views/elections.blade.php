@extends('layout.layout')

@section('views')
    <div class="flex flex-col items-center justify-start gap-10 px-3 py-10 h-fit lg:px-40">
        @if (auth() && auth()->user()->privilege == 'admin')
            <div class="w-full min-h-full px-4 py-3 tracking-wide bg-white md:px-8 dark:bg-neutral-700">
                <h2
                    class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl -mt-8 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                    Elections
                </h2>
                <div class="pb-6 mt-6 grow text-neutral-500 dark:text-neutral-200">
                    <x-election_form />
                </div>
            </div>
        @endif

        <div class="w-full min-h-full p-4 tracking-wide bg-white md:p-8 dark:bg-neutral-700">
            @if (auth() && auth()->user()->privilege == 'user')
                <h2
                    class="py-2 sm:py-3 text-white uppercase text-sm w-full px-2.5 shadow-xl md:-mt-14 -mt-9 bg-indigo-600 ring-1 ring-indigo-600 border-2 border-white cursor-default">
                    Elections
                </h2>
            @endif

            <div class="@if (auth() && auth()->user()->privilege == 'user') mt-10 @endif overflow-x-auto">
                <table class="w-full mb-8 text-sm text-left text-neutral-500 dark:text-neutral-400">
                    <thead
                        class="text-xs uppercase text-neutral-700 bg-neutral-50 dark:bg-neutral-700 dark:text-neutral-400">
                        <tr>
                            <th scope="col" class="w-8 p-4 text-center">
                                S/N
                            </th>

                            <th scope="col" class="p-4 text-left">
                                Title
                            </th>

                            <th scope="col" class="p-4 text-left">
                                Description
                            </th>

                            <th scope="col" class="p-4 text-left">
                                Type
                            </th>
                        </tr>
                    </thead>
                    @if ($elections->count() > 0)
                        <tbody>
                            @foreach ($elections as $election)
                                <x-election_table :election="$election" />
                            @endforeach
                        </tbody>
                    @else
                        <tr class="text-lg text-center text-neutral-500">
                            <td colspan="4" class="pt-10">
                                No elections yet.
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
            {{-- {{ $elections->links() }} --}}
        </div>
    </div>
@endsection
