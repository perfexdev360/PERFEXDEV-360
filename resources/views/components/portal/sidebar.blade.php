<div>
    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-900 transform md:translate-x-0 md:static md:inset-0 transition-transform duration-200 ease-in-out" :class="{'-translate-x-full md:translate-x-0': !sidebarOpen}">
        <nav class="mt-10 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Dashboard</a>
            <a href="{{ route('quotes.index') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('quotes.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Quotes</a>
            <a href="{{ route('purchases.index') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('purchases.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Purchases</a>
            <a href="{{ route('licenses.index') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('licenses.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Licenses</a>
            <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('projects.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Projects</a>
            <a href="{{ route('tickets.index') }}" class="block px-3 py-2 rounded-md text-gray-700 dark:text-gray-300 {{ request()->routeIs('tickets.*') ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">Tickets</a>
        </nav>
    </aside>
</div>
