<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PerfexDev360') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800">
    <nav class="bg-white border-b">
        <div class="container mx-auto px-4 py-4 flex justify-between">
            <a href="{{ route('home') }}" class="font-bold">{{ config('app.name', 'PerfexDev360') }}</a>
            <div class="space-x-4">
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">Products</a>
                <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-gray-900">Services</a>
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-gray-900">Blog</a>
                <a href="{{ route('contact.index') }}" class="text-gray-600 hover:text-gray-900">Contact</a>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        @if(session('status'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
