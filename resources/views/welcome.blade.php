<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelacakan Alumni - Sistem Pelacakan Karir Alumni</title>
    <meta name="description" content="Sistem pelacakan alumni untuk memantau perkembangan karir dan pencapaian alumni.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS (embedded from original for standalone) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'figtree': ['Figtree', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        .bg-gradient-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white bg-gradient-to-r bg-clip-text text-transparent from-indigo-600 to-purple-600">
                        📊 Pelacakan Alumni
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="/dashboard" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium px-3 py-2 rounded-md text-sm">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium px-3 py-2 rounded-md text-sm">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-hero text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                                    Daftar Gratis
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-hero text-white py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-float">
                <div class="mx-auto max-w-2xl mb-8">
                    <h1 class="text-4xl sm:text-6xl font-bold tracking-tight mb-6">
                        Sistem Pelacakan<br>
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Karir Alumni</span>
                    </h1>
                    <p class="text-xl sm:text-2xl text-indigo-100 mb-8 leading-relaxed">
                        Pantau perkembangan karir alumni, kelola data, dan dapatkan insights berharga untuk pengembangan institusi.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-2xl mx-auto">
                    <a href="{{ route('login') }}" class="bg-white text-gray-900 px-8 py-4 rounded-xl font-semibold text-lg shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto text-center">
                        🚀 Mulai Sekarang
                    </a>
                    <a href="#features" class="border-2 border-white/50 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 w-full sm:w-auto text-center">
                        Fitur Lengkap
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 sm:py-32 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-6">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola dan melacak alumni dengan mudah dan efisien.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group p-8 rounded-2xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gradient-hero hover:text-white transition-all duration-500 shadow-lg hover:shadow-2xl hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-hero rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 mx-auto">
                        👥
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-white">Kelola Data Alumni</h3>
                    <p class="text-gray-600 dark:text-gray-300 group-hover:text-indigo-100">CRUD lengkap alumni dengan informasi lengkap dan update real-time.</p>
                </div>
                <div class="group p-8 rounded-2xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gradient-hero hover:text-white transition-all duration-500 shadow-lg hover:shadow-2xl hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-hero rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 mx-auto">
                        📈
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-white">Tracking Karir</h3>
                    <p class="text-gray-600 dark:text-gray-300 group-hover:text-indigo-100">Pantau progres karir, pekerjaan, dan pencapaian alumni secara detail.</p>
                </div>
                <div class="group p-8 rounded-2xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gradient-hero hover:text-white transition-all duration-500 shadow-lg hover:shadow-2xl hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-hero rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 mx-auto">
                        📊
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-white">Dashboard Statistik</h3>
                    <p class="text-gray-600 dark:text-gray-300 group-hover:text-indigo-100">Visualisasi data lengkap dengan chart dan metrik kinerja.</p>
                </div>
                <div class="group p-8 rounded-2xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gradient-hero hover:text-white transition-all duration-500 shadow-lg hover:shadow-2xl hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-hero rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 mx-auto">
                        🎓
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-white">Event & Networking</h3>
                    <p class="text-gray-600 dark:text-gray-300 group-hover:text-indigo-100">Kelola acara reuni dan networking untuk komunitas alumni.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 sm:py-32 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-8">
                    <div class="text-4xl sm:text-5xl font-bold text-gradient-hero mb-4">1,247</div>
                    <div class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Alumni</div>
                </div>
                <div class="p-8">
                    <div class="text-4xl sm:text-5xl font-bold text-green-600 mb-4">95%</div>
                    <div class="text-xl font-semibold text-gray-700 dark:text-gray-300">Tingkat Tracking</div>
                </div>
                <div class="p-8">
                    <div class="text-4xl sm:text-5xl font-bold text-blue-600 mb-4">+24%</div>
                    <div class="text-xl font-semibold text-gray-700 dark:text-gray-300">Pertumbuhan Tahunan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 sm:py-32 bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-6">Siap Memulai Pelacakan Alumni?</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan institusi yang sudah menggunakan sistem kami untuk sukses melacak alumni.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-gradient-hero text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300">
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="border-4 border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 px-10 py-5 rounded-2xl font-bold text-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300">
                    Masuk Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <a href="/" class="text-2xl font-bold mb-4 block bg-gradient-to-r bg-clip-text text-transparent from-indigo-400 to-purple-400">
                        Pelacakan Alumni
                    </a>
                    <p class="text-gray-400 text-sm">Sistem terlengkap untuk pelacakan karir alumni.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Fitur</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#features" class="hover:text-white">Kelola Alumni</a></li>
                        <li><a href="#features" class="hover:text-white">Tracking</a></li>
                        <li><a href="#features" class="hover:text-white">Dashboard</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Admin</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <p class="text-sm text-gray-400">support@pelacakan-alumni.com</p>
                    <p class="text-sm text-gray-400">+62 123 456 789</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-400">
                © 2024 Pelacakan Alumni. Dibuat dengan ❤️ untuk komunitas pendidikan.
            </div>
        </div>
    </footer>

    <script>
        // Simple scroll animation trigger
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.group').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    el.classList.add('animate-float');
                }
            });
        });
    </script>
</body>
</html>
