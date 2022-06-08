@props(['votes' => $votes, 'hasVoted' => $hasVoted, 'election' => $election, 'candidate' => $candidate, 'today' => $today])

<div
    class="flex-grow p-4 text-center transition duration-300 border border-neutral-200 candidate-card text-neutral-500 dark:text-neutral-400">
    {{-- card image --}}
    <div class="w-full h-24 border text-neutral-400 border-neutral-200 dark:text-neutral-400">
        <svg class="flex-shrink-0 w-full h-full" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
            </path>
        </svg>
    </div>

    {{-- Card body --}}
    <div class="flex flex-col items-start justify-start w-full p-2 mt-3 text-base cursor-default">
        <span>
            <strong>Name: </strong>
            {{ $candidate->name }}
        </span>
        <span>
            <strong>Party: </strong>
            {{ $candidate->party }}
        </span>
        <span>
            <strong>Votes: </strong>
            {{ $votes->where('candidate_id', $candidate->id)->count() }}
        </span>
    </div>

    {{-- card footer --}}
    {{-- if the election has NOT started --}}
    @if ($today->lt($election->start_date) && $today->lt($election->end_date))
        <div class="w-full h-12">
            <button
                class="w-full py-1 mt-1 text-sm font-semibold border-2 border-white sm:text-base text-neutral-500 bg-neutral-300 ring-1 ring-neutral-300"
                disabled>
                This election has not started!
            </button>
        </div>
        {{-- if the election has ended --}}
    @elseif ($today->gt($election->start_date) && $today->gt($election->end_date))
        {{-- if the user voted before the election ended --}}
        @if ($hasVoted || $candidate->votedBy(auth()->user()))
            <div class="w-full h-12">
                @if ($candidate->votedBy(auth()->user()))
                    <button
                        class="w-full py-1 mt-1 text-sm font-semibold border-2 border-white sm:text-base text-neutral-500 bg-neutral-300 ring-1 ring-neutral-300"
                        disabled>
                        You voted this candidate!
                    </button>
                @endif
            </div>
        @else
            {{-- if the user did NOT vote before the election ended --}}
            <div class="w-full h-12">
                <button
                    class="w-full py-1 mt-1 text-sm font-semibold border-2 border-white sm:text-base text-neutral-500 bg-neutral-300 ring-1 ring-neutral-300"
                    disabled>
                    This election has ended!
                </button>
            </div>
        @endif


        {{-- if the election is on-going --}}
    @else
        {{-- if the user has voted at least one candidate --}}
        @if ($hasVoted || $candidate->votedBy(auth()->user()))
            <div class="w-full h-12">
                {{-- if the user has voted one candidate --}}
                @if ($candidate->votedBy(auth()->user()))
                    <button
                        class="w-full py-1 mt-1 text-sm font-semibold border-2 border-white sm:text-base text-neutral-500 bg-neutral-300 ring-1 ring-neutral-300"
                        disabled>
                        You voted this candidate!
                    </button>
                @endif
            </div>
        @else
            {{-- if the election is on-going and the user has NOT voted any candidate --}}
            <div>
                <form id="voting-for" action="{{ route('elections.vote', [$election->id, $candidate->id]) }}"
                    method="post" class="w-full px-2 mb-2">
                    @csrf

                    <button type="submit"
                        class="w-full py-1 mt-1 text-base font-semibold text-white transition duration-300 bg-indigo-600 border-2 border-white shadow-lg ring-1 ring-indigo-600 shadow-indigo-200 hover:shadow-indigo-400">
                        Vote
                    </button>
                </form>
            </div>
        @endif
    @endif
</div>
