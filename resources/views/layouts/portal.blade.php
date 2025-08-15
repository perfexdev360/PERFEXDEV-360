@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
    <x-portal.sidebar />

    <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white dark:bg-gray-800 shadow md:hidden">
            <div class="flex items-center justify-between p-4">
                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Menu</h1>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4 overflow-y-auto" x-data="{ show: false }" x-init="show = true" x-show="show"
              x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2"
              x-transition:enter-end="opacity-100 transform translate-y-0">
            @yield('portal-content')
        </main>
    </div>
</div>
@endsection
