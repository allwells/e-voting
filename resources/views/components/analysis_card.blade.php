@props(['data' => $data, 'title' => $title, 'icon' => $icon])

<div id="analysis-card" class="flex items-center justify-between flex-grow gap-8 max-w-sm py-3 px-5 bg-white rounded-md">
    <div class="flex flex-col items-start justify-center gap-1">
        <span class="text-3xl font-medium text-neutral-800">{{ $data->count() }}</span>
        <span class="text-sm font-normal capitalize text-neutral-700">{{ $title }}</span>
    </div>
    <div class="text-6xl text-neutral-200/90">
        <i class="{{ $icon }}"></i>
    </div>
</div>
