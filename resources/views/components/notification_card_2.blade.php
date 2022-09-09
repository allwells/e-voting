@props(['notification' => $notification])

@php
$election = \App\Models\Election::where('id', $notification->election_id)->first();
@endphp

<a href="{{ route('elections.show', $notification->election_id) }}"
    class="flex justify-between items-start rounded-xl py-3 px-4 hover:bg-neutral-100 @if (!$notification->isRead) bg-neutral-100/50 @endif">
    <div class="flex-shrink-0">
        <img class="w-10 h-10 shadow-md shadow-neutral-300 rounded-full"
            src="{{ $election->cover ? $election->cover : asset('images/profile-bg.jpg') }}" alt="election cover photo">
    </div>

    <div class="pl-3 flex-grow @if (!$notification->isRead) text-neutral-800 @endif">
        <div class="@if ($notification->isRead) text-neutral-500 @endif text-sm mb-1.5 line-clamp-3">
            {!! $notification->message !!}
        </div>
        <div class="text-xs text-blue-600 @if (!$notification->isRead) font-bold @endif">
            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
        </div>
    </div>

    @if (!$notification->isRead)
        <span
            class="ml-1 rounded-full min-w-[0.5rem] min-h-[0.5rem] max-w-[0.5rem] max-h-[0.5rem] bg-[#0000FF] -mt-1 -mr-2"></span>
    @endif
</a>
