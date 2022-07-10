@props(['index' => $index, 'candidate' => $candidate, 'votes' => $votes, 'today' => $today, 'voted' => $voted, 'election' => $election])

<tr class="hover:bg-neutral-50">
    <td class="text-center cursor-default w-12">
        {{ $index }}
    </td>

    <td class="px-2 py-3 text-left cursor-default">
        {{ $candidate->name }}
    </td>

    <td class="px-2 py-3 text-left cursor-default">
        {{ $candidate->party }}
    </td>

    <td class="text-center capitalize cursor-default w-16 px-2 py-3">

        {{-- if the election has NOT started --}}
        @if ($today->lt($election->start_date) && $today->lt($election->end_date))
            <button type="button" data-tooltip-target="tooltip-animation"
                class="py-1 px-2 cursor-default bg-neutral-500 rounded text-white font-normal text-sm">
                Vote
            </button>
            <div id="tooltip-animation" role="tooltip"
                class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-neutral-800 rounded shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-neutral-700">
                Wait for election to start.
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            {{-- if the election has ended --}}
        @elseif (($today->gt($election->start_date) && $today->gt($election->end_date)) || $election->status == 'closed')
            {{ $votes->where('candidate_id', $candidate->id)->count() }}
        @else
            {{-- if the user has voted at least one candidate --}}
            @if ($voted || $candidate->votedBy(auth()->user()))
                {{-- show 'voted!' on the candidate voted by user --}}
                {{ $votes->where('candidate_id', $candidate->id)->count() }}
            @else
                {{-- if the election is on-going and the user has NOT voted any candidate --}}
                <div>
                    <form id="voting-for" action="{{ route('elections.vote', [$election->id, $candidate->id]) }}"
                        method="post" class="py-2">
                        @csrf

                        <button type="submit"
                            class="py-1 px-2 bg-indigo-600 hover:bg-indigo-700 focus:ring focus:ring-indigo-300 rounded text-white font-normal text-sm">
                            Vote
                        </button>
                    </form>
                </div>
            @endif
        @endif
    </td>
</tr>
