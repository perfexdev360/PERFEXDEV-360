<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PerfexDev360') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            to { box-shadow: 0 0 40px rgba(102, 126, 234, 0.8); }
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .hero-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-card {
            transition: all 0.4s ease;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .blob-1 {
            position: absolute;
            top: 10%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3));
            border-radius: 50%;
            filter: blur(100px);
            animation: blob-float 8s ease-in-out infinite;
            z-index: -1;
        }

        .blob-2 {
            position: absolute;
            bottom: 20%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(118, 75, 162, 0.3), rgba(102, 126, 234, 0.3));
            border-radius: 50%;
            filter: blur(120px);
            animation: blob-float 10s ease-in-out infinite reverse;
            z-index: -1;
        }

        @keyframes blob-float {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        .cta-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: perspective(1px) translateZ(0);
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
        }
    </style>
</head>
<body class="antialiased text-gray-800 overflow-x-hidden">
    <!-- Floating Background Elements -->
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <!-- Navigation -->
    <nav class="relative z-50 glass-effect">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-black text-2xl hero-text tracking-tight">
                {{ config('app.name', 'PerfexDev360') }}
            </a>
            <div class="flex items-center space-x-6">
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('products.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium transition-colors">Products</a>
                    <a href="{{ route('services.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium transition-colors">Services</a>
                    <a href="{{ route('blog.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium transition-colors">Blog</a>
                    <a href="{{ route('contact.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium transition-colors">Contact</a>
                </div>
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition-colors">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10">
        @if(session('status'))
            <div class="container mx-auto px-6 mb-8">
                <div class="p-6 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif


        <!-- Content Area -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                @yield('content')
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <h3 class="text-3xl font-bold mb-4">{{ config('app.name', 'PerfexDev360') }}</h3>
                <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                    Ready to transform your digital presence? Let's create something amazing together.
                </p>
                <button class="bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-colors shadow-lg">
                    Start Your Project
                </button>
            </div>

            <div class="mt-12 pt-8 border-t border-white/20 text-center text-blue-100">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'PerfexDev360') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add smooth scrolling and interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle (add this functionality if needed)
            const mobileMenuBtn = document.querySelector('button');

            // Parallax effect for floating elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelectorAll('.floating-animation');
                const speed = 0.5;

                parallax.forEach(element => {
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });

            // Add hover effects to feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
</body>
</html>
