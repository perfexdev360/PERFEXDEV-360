@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row">
    <aside class="w-full md:w-64 bg-gray-100 dark:bg-gray-800 p-4">
        <nav class="space-y-2">
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Dashboard</a>
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Users</a>
            <a href="#" class="block px-2 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700">Settings</a>
        </nav>
    </aside>
    <main class="flex-1 p-4">
        @yield('admin-content')
    </main>
</div>
@endsection
