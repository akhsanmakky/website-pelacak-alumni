<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard - AlumniTrace')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { 'figtree': ['Figtree', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#f5f3ff', 100: '#ede9fe', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9' }
                    }
                }
            }
        }
    </script>
    
    <style>
        .glass-nav { @apply bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border-b border-white/20 shadow-lg; }
        .sidebar-glass { @apply bg-white/60 dark:bg-gray-900/60 backdrop-blur-xl border-r border-white/20 shadow-2xl; }
        .hero-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    
    <!-- Admin Sidebar -->
    <aside class="sidebar-glass fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="flex flex-col h-full">
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-primary-600 rounded-xl text-white">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <span class="text-2xl font-extrabold bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent">
                        AlumniTrace
                    </span>
                </div>
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=8b5cf6&color=fff&size=64&bold=true" alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-2xl mx-auto mb-3 shadow-lg">
                    <h3 class="font-bold text-lg mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-2xl font-medium transition-all group @if(request()->routeIs('admin.dashboard')) bg-primary-600 text-white shadow-lg @else hover:bg-gray-100 dark:hover:bg-gray-800 hover:shadow-md @endif">
                    <i class="fas fa-tachometer-alt w-5 mr-4 @if(request()->routeIs('admin.dashboard')) text-white @else text-gray-500 group-hover:text-primary-600 @endif"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.alumni.index') }}" class="flex items-center px-4 py-3 rounded-2xl font-medium transition-all group @if(request()->routeIs('admin.alumni.*')) bg-primary-600 text-white shadow-lg @else hover:bg-gray-100 dark:hover:bg-gray-800 hover:shadow-md @endif">
                    <i class="fas fa-users w-5 mr-4 @if(request()->routeIs('admin.alumni.*')) text-white @else text-gray-500 group-hover:text-primary-600 @endif"></i>
                    Alumni
                </a>
            </nav>
        </div>
    </aside>

    <!-- Mobile menu button -->
    <button id="sidebarToggle" class="lg:hidden fixed top-20 left-4 z-40 p-2 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-2xl shadow-lg border">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Main Navbar -->
    <nav class="glass-nav pt-20 lg:pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <div class="flex items-center lg:hidden">
                    <i class="fas fa-chevron-left text-xl"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="font-bold text-xl bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent hidden lg:block">
                        Admin Panel
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-xs font-bold rounded-full">
                        Admin
                    </span>
                    <div class="relative">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 rounded-2xl font-medium hover:bg-gray-100 dark:hover:bg-gray-800 transition-all shadow-sm">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="lg:ml-64 p-6 lg:p-8 transition-all duration-300">
        @yield('content')
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });

        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar on outside click
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains('lg:translate-x-0')) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-2xl');
            } else {
                nav.classList.remove('shadow-2xl');
            }
        });
    </script>
</body>
</html>
