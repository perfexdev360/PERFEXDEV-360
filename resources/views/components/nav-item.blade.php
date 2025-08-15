@props(['href', 'icon' => null, 'label'])

@php
    $active = url()->current() === url($href);
    $classes = 'flex items-center px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors';
    if ($active) {
        $classes .= ' bg-gray-200 dark:bg-gray-700';
    }
@endphp

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => $classes]) }}
   x-transition
   @if($active) aria-current="page" @endif>
    @if ($icon)
        <span class="mr-2">{{ $icon }}</span>
    @endif
    <span>{{ $label }}</span>
</a>
