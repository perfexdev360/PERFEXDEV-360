@props(['trigger' => 'Open'])

<div x-data="{ open: false }" {{ $attributes }}>
    <button @click="open = true" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $trigger }}</button>
    <div x-show="open" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" @keydown.escape.window="open=false">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-full max-w-lg" @click.outside="open=false">
            {{ $slot }}
            <div class="text-right mt-4">
                <button @click="open=false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">Close</button>
            </div>
        </div>
    </div>
</div>
