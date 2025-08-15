@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false }" x-init="sidebarOpen = window.innerWidth >= 768" class="min-h-screen flex bg-gray-100 dark:bg-gray-900">
    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden" x-transition.opacity @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside x-show="sidebarOpen"
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 overflow-y-auto md:relative md:translate-x-0">
        <x-admin.sidebar />
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col transition-all duration-300" :class="{'md:ml-64': sidebarOpen}">
        <!-- Top navigation -->
        <header class="flex items-center justify-between bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 p-4">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 dark:text-gray-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="ml-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none">
                            <span class="mr-2">{{ Auth::user()->name ?? 'User' }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}" class="block" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <main class="flex-1 p-4">
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection
