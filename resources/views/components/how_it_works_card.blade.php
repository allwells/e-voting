@props(['step' => $step, 'title' => $title, 'image' => $image, 'direction' => $direction, 'description' => $description])

<div class="flex {{ $direction }} flex-col w-full gap-5">
    <div class="w-full md:w-6/12">
        <span class="text-white bg-indigo-600 py-2.5 px-4 rounded-full text-base font-bold uppercase">
            Step {{ $step }}
        </span>
        <h2 class="text-neutral-800 text-2xl font-medium mt-8 capitalize">{{ $title }}</h2>
        <p class="mt-2 text-neutral-700 font-light text-base">{{ $description }}</p>

    </div>
    <div class="w-full md:w-6/12">
        <img src="{{ $image }}" alt="illustration" width="450" height="450" />
    </div>
</div>
