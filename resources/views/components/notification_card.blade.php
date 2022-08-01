@props(['notification' => $notification])

<a href="#"
    class="flex justify-between items-start py-3 px-4 hover:bg-neutral-100 @if (!$notification->isRead) bg-neutral-100/50 @endif">
    <div class="flex-shrink-0">
        <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile.jpg') }}" alt="Jese image">
    </div>

    <div class="pl-3 flex-grow @if (!$notification->isRead) text-neutral-800 @endif">
        <div class="@if ($notification->isRead) text-neutral-500 @endif text-sm mb-1.5 line-clamp-2">New message
            from
            <span
                class="font-semibold text-neutral-900">{{ auth()->user()->fname . ' ' . auth()->user()->lname }}</span>:
            "Hey, what's up? Have you taken the package to the warehouse? If not, bring it
            back."
        </div>
        <div class="text-xs text-blue-600 @if (!$notification->isRead) font-bold @endif">
            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
        </div>
    </div>

    @if (!$notification->isRead)
        <span
            class="rounded-full min-w-[0.5rem] min-h-[0.5rem] max-w-[0.5rem] max-h-[0.5rem] bg-[#0000FF] -mt-1 -mr-2"></span>
    @endif
</a>
