@props(['label' => 'Menu'])

<div x-data="{ open: false }" class="relative" @click.outside="open=false">
    <button @click="open=!open" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">{{ $label }}</button>
    <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded shadow-lg z-50">
        {{ $slot }}
    </div>
</div>
