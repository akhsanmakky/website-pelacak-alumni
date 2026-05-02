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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
        .glass-nav { 
            background: rgba(255,255,255,0.85); 
            backdrop-filter: blur(20px); 
            border-bottom: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 30px rgba(0,0,0,0.05);
        }
        .dark .glass-nav {
            background: rgba(17,24,39,0.85);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-glass { 
            background: rgba(255,255,255,0.9); 
            backdrop-filter: blur(20px); 
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        .dark .sidebar-glass {
            background: rgba(17,24,39,0.95);
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(0,0,0,0.04);
        }
        .dark .glass-card {
            background: rgba(31,41,55,0.6);
            border: 1px solid rgba(255,255,255,0.05);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        .input-glass {
            background: rgba(255,255,255,0.6);
            border: 1px solid rgba(0,0,0,0.08);
            backdrop-filter: blur(10px);
        }
        .dark .input-glass {
            background: rgba(31,41,55,0.5);
            border: 1px solid rgba(255,255,255,0.08);
            color: #e5e7eb;
        }
        .nav-item {
            position: relative;
            overflow: hidden;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #7c3aed;
            border-radius: 0 4px 4px 0;
            transition: height 0.3s ease;
        }
        .nav-item:hover::before, .nav-item.active::before {
            height: 60%;
        }
        .nav-item.active {
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(124,58,237,0.3);
        }
        .nav-item.active i {
            color: white !important;
        }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    
    <!-- Sidebar -->
    <aside class="sidebar-glass fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col" id="sidebar">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-500/30">
                    <i class="fas fa-graduation-cap text-lg"></i>
                </div>
                <div>
                    <span class="text-xl font-extrabold bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent">AlumniTrace</span>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Admin Panel</p>
                </div>
        </div>
        
        <!-- User Profile -->
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=8b5cf6&color=fff&size=48&bold=true" 
                     alt="{{ Auth::user()->name }}" 
                     class="w-10 h-10 rounded-xl shadow-md">
                <div class="min-w-0">
                    <p class="font-bold text-sm truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item flex items-center px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i class="fas fa-chart-pie w-5 mr-3 {{ request()->routeIs('admin.dashboard') ? '' : 'text-gray-400' }}"></i>
                Dashboard
            </a>
<a href="{{ route('admin.alumni.index') }}" 
               class="nav-item flex items-center px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.alumni.*') ? 'active' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i class="fas fa-users w-5 mr-3 {{ request()->routeIs('admin.alumni.*') ? '' : 'text-gray-400' }}"></i>
                Data Alumni
            </a>
            <a href="{{ route('admin.tracking.stats') }}" 
               class="nav-item flex items-center px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.tracking.stats') ? 'active' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <i class="fas fa-chart-line w-5 mr-3 {{ request()->routeIs('admin.tracking.stats') ? '' : 'text-gray-400' }}"></i>
                Tracking Stats
            </a>
        </nav>
        
        <!-- Footer -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-red-600 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

    <!-- Mobile Toggle -->
    <button id="sidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
        <i class="fas fa-bars text-lg"></i>
    </button>

    <!-- Top Navbar -->
    <nav class="glass-nav fixed top-0 right-0 left-0 lg:left-64 z-30">
        <div class="flex items-center justify-between h-16 px-4 lg:px-8">
            <div class="flex items-center gap-3">
                <span class="hidden lg:block text-sm font-bold text-gray-400 uppercase tracking-widest">Halaman</span>
                <span class="hidden lg:block text-sm font-bold text-gray-800 dark:text-white">@yield('title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold rounded-full flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    Sistem Aktif
                </span>
            </div>
    </nav>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16 min-h-screen">
        <div class="p-4 lg:p-8 max-w-7xl mx-auto">
            {{-- Flash Messages --}}
            @if(session('success'))
            <div id="flash-success" class="mb-6 flex items-center gap-3 px-5 py-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-2xl text-green-800 dark:text-green-200 shadow-sm" data-aos="fade-down">
                <i class="fas fa-check-circle text-green-600 text-lg"></i>
                <p class="font-bold text-sm flex-1">{{ session('success') }}</p>
                <button onclick="document.getElementById('flash-success').remove()" class="text-green-600 hover:text-green-800 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div id="flash-error" class="mb-6 flex items-center gap-3 px-5 py-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-2xl text-red-800 dark:text-red-200 shadow-sm" data-aos="fade-down">
                <i class="fas fa-times-circle text-red-600 text-lg"></i>
                <p class="font-bold text-sm flex-1">{{ session('error') }}</p>
                <button onclick="document.getElementById('flash-error').remove()" class="text-red-600 hover:text-red-800 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif
            @if(session('warning'))
            <div id="flash-warning" class="mb-6 flex items-center gap-3 px-5 py-4 bg-amber-100 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-700 rounded-2xl text-amber-800 dark:text-amber-200 shadow-sm" data-aos="fade-down">
                <i class="fas fa-exclamation-circle text-amber-600 text-lg"></i>
                <p class="font-bold text-sm flex-1">{{ session('warning') }}</p>
                <button onclick="document.getElementById('flash-warning').remove()" class="text-amber-600 hover:text-amber-800 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50, duration: 600 });

        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        }
        
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }
        
        toggleBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
        
        overlay.addEventListener('click', closeSidebar);
    </script>
</body>
</html>
