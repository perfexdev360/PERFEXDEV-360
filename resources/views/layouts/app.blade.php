<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - User Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sortable@3.x.x/dist/cdn.min.js"></script>

    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        .nav-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .glass-effect {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s ease-in-out;
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Better scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 2px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.8);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden transition-opacity duration-300"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 z-50 h-full w-72 bg-white dark:bg-gray-800 shadow-2xl sidebar-transition transform -translate-x-full lg:translate-x-0 border-r border-gray-200 dark:border-gray-700 flex flex-col">
        <!-- Logo Section -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-cog text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">User Panel</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Management Dashboard</p>
                </div>
            </div>
            <button id="close-sidebar" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- User Profile Section -->
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-800 dark:text-white truncate">
                        {{ Auth::user()->name ?? 'John Doe' }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 truncate">
                        {{ Auth::user()->email ?? 'user@example.com' }}
                    </p>
                    <div class="flex items-center mt-1">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs text-green-600 dark:text-green-400 ml-2 font-medium">Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar px-4 py-4">
            <div class="space-y-1">
                <div class="mb-6">
                    <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 px-3">
                        Main Menu
                    </h4>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'active text-white' : '' }}">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <span class="font-medium">Dashboard</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group {{ request()->routeIs('profile.*') ? 'active text-white' : '' }}">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                                <span class="font-medium">Profile</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <span class="font-medium">Settings</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <span class="font-medium">Notifications</span>
                                <div class="ml-auto flex items-center space-x-2">
                                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">3</span>
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 px-3">
                        Analytics
                    </h4>
                    <ul class="space-y-1">
                        <li>
                            <a href="#"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <span class="font-medium">Analytics</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <span class="font-medium">Reports</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3 px-3">
                        Support
                    </h4>
                    <ul class="space-y-1">
                        <li>
                            <a href="#"
                               class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:text-white transition-all duration-200 group">
                                <div class="w-5 flex justify-center">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <span class="font-medium">Help & Support</span>
                                <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Logout Section -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all duration-200 group hover:shadow-lg">
                    <div class="w-5 flex justify-center">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span class="font-medium">Logout</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:pl-72 min-h-screen transition-all duration-300">
        <!-- Top Navigation Bar -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Page Title -->
                @isset($header)
                    <div class="flex-1 lg:flex-none">
                        {{ $header }}
                    </div>
                @else
                    <div class="flex-1 lg:flex-none">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Dashboard</h2>
                    </div>
                @endisset

                <!-- Top Right Actions -->
                <div class="flex items-center space-x-2">
                    <!-- Search Button -->
                    <button class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-search"></i>
                    </button>

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <i class="fas fa-bell"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-semibold">3</span>
                        </button>
                    </div>

                    <!-- User Menu Dropdown -->
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name ?? 'John Doe' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Online</p>
                            </div>
                            <i class="fas fa-chevron-down text-sm text-gray-500 dark:text-gray-400 transition-transform duration-200" id="user-menu-arrow"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="dropdown-menu absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 py-2">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name ?? 'John Doe' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <i class="fas fa-user-edit mr-3"></i>
                                Edit Profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                <i class="fas fa-cog mr-3"></i>
                                Account Settings
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            <div x-data="page" x-transition.opacity>
                @yield('content', $slot)
            </div>
        </main>
    </div>

    <script>
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const closeSidebar = document.getElementById('close-sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        }

        mobileMenuButton.addEventListener('click', toggleSidebar);
        closeSidebar.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', toggleSidebar);

        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        }

        // User Dropdown Menu
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
        const userMenuArrow = document.getElementById('user-menu-arrow');

        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
            userMenuArrow.classList.toggle('rotate-180');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
                userMenuArrow.classList.remove('rotate-180');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
