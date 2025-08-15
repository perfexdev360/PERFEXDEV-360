<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Welcome back, {{ Auth::user()->name }}! Here's what's happening today.
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ now()->format('M d, Y') }}
                </span>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm text-green-600 dark:text-green-400 font-medium">Online</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 space-y-6">
        <!-- Quick Stats Cards -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold">1,249</p>
                            <p class="text-blue-100 text-xs mt-1">
                                <span class="text-green-300">+12%</span> from last month
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Revenue</p>
                            <p class="text-3xl font-bold">${{ number_format(89432, 0) }}</p>
                            <p class="text-green-100 text-xs mt-1">
                                <span class="text-green-300">+8%</span> from last month
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-dollar-sign text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Orders</p>
                            <p class="text-3xl font-bold">324</p>
                            <p class="text-purple-100 text-xs mt-1">
                                <span class="text-red-300">-3%</span> from last month
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-shopping-cart text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Performance Card -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Performance</p>
                            <p class="text-3xl font-bold">98.2%</p>
                            <p class="text-orange-100 text-xs mt-1">
                                <span class="text-green-300">+0.8%</span> uptime
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Chart Section -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Revenue Analytics</h3>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-xs bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">Week</button>
                            <button class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Month</button>
                            <button class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Year</button>
                        </div>
                    </div>
                    <div class="h-64 flex items-center justify-center bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 rounded-lg">
                        <canvas id="revenueChart" class="max-w-full h-full"></canvas>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-plus text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">New user registered</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">John Doe joined the platform</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">2 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shopping-bag text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">New order placed</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Order #1234 - $299.00</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">5 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">System alert</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Server load is above normal</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">10 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-star text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">New review received</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">5-star rating from customer</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">15 minutes ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-times text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">Payment failed</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Order #1233 payment declined</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">20 minutes ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Grid -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#" class="flex flex-col items-center justify-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-800/30 dark:hover:to-blue-700/30 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">Add User</span>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg hover:from-green-100 hover:to-green-200 dark:hover:from-green-800/30 dark:hover:to-green-700/30 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-plus text-white text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">New Product</span>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg hover:from-purple-100 hover:to-purple-200 dark:hover:from-purple-800/30 dark:hover:to-purple-700/30 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-chart-bar text-white text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">View Reports</span>
                        </a>

                        <a href="#" class="flex flex-col items-center justify-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-lg hover:from-orange-100 hover:to-orange-200 dark:hover:from-orange-800/30 dark:hover:to-orange-700/30 transition-all duration-200 group">
                            <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-cog text-white text-xl"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">Settings</span>
                        </a>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">Top Performing Products</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-laptop text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">MacBook Pro</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">245 sales</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800 dark:text-gray-200">$245,000</p>
                                <p class="text-sm text-green-600">+15%</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">iPhone 15</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">189 sales</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800 dark:text-gray-200">$189,000</p>
                                <p class="text-sm text-green-600">+8%</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-headphones text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">AirPods Pro</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">156 sales</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800 dark:text-gray-200">$39,000</p>
                                <p class="text-sm text-red-600">-3%</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tablet-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-200">iPad Air</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">134 sales</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800 dark:text-gray-200">$80,400</p>
                                <p class="text-sm text-green-600">+12%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Message (Enhanced) -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-8 sm:px-8 relative">
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold text-white mb-2">
                            {{ __("Welcome back, :name!", ['name' => Auth::user()->name]) }}
                        </h3>
                        <p class="text-blue-100 mb-4">
                            {{ __("You're successfully logged in to your dashboard. Explore the features and manage your account.") }}
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                                <i class="fas fa-user-edit mr-2"></i>
                                Edit Profile
                            </a>
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-sm font-medium rounded-lg transition-all duration-200 backdrop-blur-sm">
                                <i class="fas fa-question-circle mr-2"></i>
                                Get Help
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Revenue',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 28000],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    </script>
</x-app-layout>
