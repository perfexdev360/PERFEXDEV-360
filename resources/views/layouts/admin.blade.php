@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row">
    <aside class="w-full md:w-64 bg-gray-100 dark:bg-gray-800 p-4">
        <nav class="space-y-2">
            <x-nav-item href="#" icon="📊" label="Dashboard" />
            <x-nav-item href="#" icon="👥" label="Users" />
            <x-nav-item href="#" icon="⚙️" label="Settings" />
        </nav>
    </aside>
    <main class="flex-1 p-4">
        @yield('admin-content')
    </main>
</div>
@endsection
