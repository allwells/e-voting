@props(['data' => $data, 'title' => $title, 'icon' => $icon])

<div id="analysis-card"
    class="flex items-center justify-start flex-grow gap-8 max-w-sm shadow-lg py-8 px-10 bg-white rounded-lg text-neutral-700">
    <div class="text-5xl text-indigo-600/60">
        <i class="{{ $icon }}"></i>
    </div>
    <div class="flex flex-col items-start justify-center gap-1">
        <span class="text-sm font-normal capitalize">{{ $title }}</span>
        <span class="text-3xl font-normal text-neutral-800">{{ $data->count() }}</span>
    </div>
</div>
