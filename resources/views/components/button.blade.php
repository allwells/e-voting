@props(['text' => $text, 'link' => $link, 'variant' => $variant])

<a href="{{ $link }}"
    class="app-buttons font-semibold flex items-center justify-center {{ $variant }} w-full text-base font-medium text-white bg-indigo-600 border border-transparent rounded hover:bg-indigo-700 md:text-lg">
    {{ $text }}
</a>
