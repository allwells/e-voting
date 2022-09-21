@props(['notification' => $notification])

@php
$election = \App\Models\Election::where('id', $notification->event_id)->first();
$poll = \App\Models\Poll::where('id', $notification->event_id)->first();

$electionCover = $election ? $election->cover ? $election->cover : asset('images/profile-bg.jpg') : asset('images/profile-bg.jpg');
@endphp

<div id="notification-card"
    class="relative flex justify-between items-start rounded-xl hover:bg-neutral-100 @if (!$notification->isRead) bg-neutral-100/50 @endif">
    @if (!$notification->isRead)
        <span
            class="left-1 top-1 absolute rounded-full min-w-[0.5rem] min-h-[0.5rem] max-w-[0.5rem] max-h-[0.5rem] bg-[#0000FF]"></span>
    @endif

    <a href="{{ route('notifications.show', $notification->event_id) }}" class="py-3 px-4 flex-grow flex justify-start items-start @if(!$election) gap-3 @endif">
        @if(!$election)
            <div class="flex-shrink-0">
                <img class="w-10 h-10 shadow-md shadow-neutral-300 rounded-full"
                    src="{{ $electionCover }}" alt="election cover photo">
            </div>
        @endif

        <div class="flex-grow @if (!$notification->isRead) text-neutral-800 @endif">
            <div class="@if ($notification->isRead) text-neutral-500 @endif text-sm mb-1.5 line-clamp-3">
                {!! $notification->message !!}
            </div>
            <div class="text-xs text-[#0000FF] @if (!$notification->isRead) font-bold @endif">
                {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
            </div>
        </div>
    </a>

    <div id="notification-action-btn" class="absolute invisible opacity-0 w-fit right-4 top-[1.2rem] flex justify-center items-center gap-2">
        <form action="{{ route('notifications.mark', $notification->id) }}" method="post" title="Mark as {{ $notification->isRead ? "unread" : "read" }}">
            @csrf

            <button type="submit" class="flex justify-center gap-1 font-bold text-sm items-center bg-[#0000BB] hover:bg-[#0000DD] text-white active:scale-90 rounded-full p-1">
                @if ($notification->isRead)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                @endif
            </button>
        </form>

        <form action="{{ route('notifications.destroy', $notification->id) }}" method="post" title="Delete notification">
            @method('DELETE')
            @csrf

            <button type="submit" class="flex justify-center gap-1 font-bold text-sm items-center bg-red-700 hover:bg-red-600 text-white active:scale-90 focus:bg-red-700 rounded-full p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </form>
    </div>
</div>
