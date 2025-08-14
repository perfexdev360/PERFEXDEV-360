<!DOCTYPE html>
<html lang="en"
    x-data="{dark: localStorage.getItem('dark') === 'true'}"
    x-init="$watch('dark', value => localStorage.setItem('dark', value))"
    x-bind:class="dark ? 'dark' : ''">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100 min-h-screen">
    <header class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
        <div class="font-bold">
            {{ $header ?? config('app.name', 'Laravel') }}
        </div>
        <button x-on:click="dark = !dark" class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700">
            <span x-show="!dark">Dark</span>
            <span x-show="dark">Light</span>
        </button>
    </header>
    <main class="p-4">
        @yield('content')
    </main>
</body>
</html>
