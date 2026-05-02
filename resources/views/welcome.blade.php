<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AlumniTrace - Modern Alumni Career Tracking</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
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
    
    <style type="text/tailwindcss">
        @layer components {
            .glass-nav { 
                @apply bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50; 
            }
            .glass-card {
                @apply bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border border-white/20 dark:border-gray-700/30;
            }
            .hero-gradient {
                background: radial-gradient(circle at top right, #8b5cf6, transparent),
                            radial-gradient(circle at bottom left, #3b82f6, transparent),
                            linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            }
            .blob {
                @apply absolute w-[300px] h-[300px] rounded-full blur-[50px] -z-10 opacity-30;
                background: #8b5cf6;
                animation: move 10s infinite alternate;
            }
        }
        @keyframes move { from { transform: translate(0, 0); } to { transform: translate(100px, 50px); } }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <nav class="glass-nav fixed w-full z-50 transition-all duration-300 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="p-2 bg-primary-600 rounded-lg text-white group-hover:rotate-12 transition-transform">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent">
                        AlumniTrace
                    </span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="hover:text-primary-600 font-medium transition-colors">Fitur</a>
                    <a href="#stats" class="hover:text-primary-600 font-medium transition-colors">Statistik</a>
                    <a href="/faq" class="hover:text-primary-600 font-medium transition-colors">FAQ</a>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-primary-600 text-white px-6 py-2.5 rounded-full font-bold hover:shadow-lg hover:shadow-primary-500/30 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-bold hover:text-primary-600 transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary-600 text-white px-6 py-2.5 rounded-full font-bold hover:shadow-lg hover:shadow-primary-500/30 transition-all">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden pt-32 pb-20 lg:pt-48 lg:pb-32">
        <div class="blob top-20 left-10"></div>
        <div class="blob bottom-10 right-10" style="animation-delay: -5s"></div>
        
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div data-aos="zoom-out" data-aos-duration="1000">
                <span class="inline-block px-4 py-2 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-bold mb-6">
                    ✨ Solusi Karir Alumni Masa Depan
                </span>
                <h1 class="text-5xl lg:text-7xl font-extrabold mb-8 tracking-tighter leading-tight">
                    Hubungkan Kembali, <br>
                    <span class="text-primary-600">Pantau Kesuksesan.</span>
                </h1>
                <p class="max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-400 mb-10 leading-relaxed">
                    Sistem pelacakan karir tercanggih untuk membantu institusi pendidikan memantau pertumbuhan profesional alumni secara real-time.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ Route::has('admin.alumni.index') ? route('admin.alumni.index') : '#' }}" class="px-8 py-4 bg-primary-600 text-white rounded-2xl font-bold text-lg shadow-xl hover:bg-primary-700 transform hover:-translate-y-1 transition-all">
                        Lacak Alumni <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <button onclick="openDemoModal()" class="px-8 py-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl font-bold text-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all cursor-pointer">
                        Lihat Demo
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="stats" class="py-12 bg-white/50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent" data-aos="fade-up">
                    Statistik Alumni Real-Time
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Data terkini mengenai penyebaran karir alumni.
                </p>
            </div>
            
            <div id="statsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="400">
                <div class="glass-card p-8 rounded-3xl text-center group hover:shadow-2xl hover:-translate-y-2 transition-all animate-pulse">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 mb-1" data-stat="total">0</div>
                    <div class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Alumni</div>
                </div>
                <div class="glass-card p-8 rounded-3xl text-center group hover:shadow-2xl hover:-translate-y-2 transition-all animate-pulse">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-industry fa-lg"></i>
                    </div>
                    <div class="text-3xl font-bold text-green-600 mb-1" data-stat="swasta">--</div>
                    <div class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Sektor Swasta</div>
                </div>
                <div class="glass-card p-8 rounded-3xl text-center group hover:shadow-2xl hover:-translate-y-2 transition-all animate-pulse">
                    <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-lightbulb fa-lg"></i>
                    </div>
                    <div class="text-3xl font-bold text-amber-600 mb-1" data-stat="wirausaha">--</div>
                    <div class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Wirausaha</div>
                </div>
                <div class="glass-card p-8 rounded-3xl text-center group hover:shadow-2xl hover:-translate-y-2 transition-all animate-pulse">
                    <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-building fa-lg"></i>
                    </div>
                    <div class="text-3xl font-bold text-indigo-600 mb-1" data-stat="pns">--</div>
                    <div class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">PNS / BUMN</div>
                </div>
            </div>
        </div>
    </section>

    <div class="py-12 border-y border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-center text-sm font-semibold text-gray-500 uppercase tracking-widest mb-8">Dipercaya Oleh Universitas Terkemuka</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all">
                <i class="fab fa-google fa-2x"></i>
                <i class="fab fa-microsoft fa-2x"></i>
                <i class="fab fa-apple fa-2x"></i>
                <i class="fab fa-amazon fa-2x"></i>
            </div>
        </div>
    </div>

    <section id="features" class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Fitur Tanpa Batas</h2>
                <div class="h-1.5 w-20 bg-primary-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-500 transition-all group" data-aos="fade-up">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform mx-auto md:mx-0">
                        <i class="fas fa-user-graduate fa-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-left">Database Terpusat</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-left text-sm leading-relaxed">Manajemen data alumni yang aman dan terintegrasi dengan sistem akademik universitas.</p>
                </div>
                <div class="p-8 bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-500 transition-all group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform mx-auto md:mx-0">
                        <i class="fas fa-briefcase fa-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-left">Analisis Karir</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-left text-sm leading-relaxed">Laporan otomatis mengenai penyebaran industri kerja alumni dan rata-rata masa tunggu kerja.</p>
                </div>
                <div class="p-8 bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 hover:border-primary-500 transition-all group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform mx-auto md:mx-0">
                        <i class="fas fa-calendar-check fa-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-left">Portal Event</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-left text-sm leading-relaxed">Mudahkan koordinasi reuni, webinar, dan bursa kerja khusus untuk komunitas alumni Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-950 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-6">
                <div class="p-2 bg-primary-600 rounded-lg text-white">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="text-xl font-bold text-white tracking-tight">AlumniTrace</span>
            </div>
            <div class="border-t border-gray-800 pt-8 text-sm">
                &copy; 2026 AlumniTrace System. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize Animations
        AOS.init({ once: true });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-2xl', 'bg-white/90', 'dark:bg-gray-900/90');
                nav.classList.replace('py-4', 'py-2');
            } else {
                nav.classList.remove('shadow-2xl', 'bg-white/90', 'dark:bg-gray-900/90');
                nav.classList.replace('py-2', 'py-4');
            }
        });

        // Live Stats Loader
        async function loadStats() {
            try {
                // Catatan: Ganti URL '/stats' dengan endpoint API asli Anda nanti
                const response = await fetch('/stats');
                if (!response.ok) throw new Error('Network error');
                const stats = await response.json();
                
                const container = document.getElementById('statsContainer');
                
                Object.entries(stats).forEach(([key, value]) => {
                    const element = document.querySelector(`[data-stat="${key}"]`);
                    if (element) {
                        element.textContent = new Intl.NumberFormat('id-ID').format(value);
                    }
                });
                
                container.querySelectorAll('.animate-pulse').forEach(card => card.classList.remove('animate-pulse'));
            } catch (error) {
                console.warn('Stats load skipped: Endpoint /stats not found. Using dummy data for display.');
                // Dummy data jika API belum siap agar tidak kosong
                const dummy = { total: 1250, swasta: 800, wirausaha: 150, pns: 300 };
                Object.entries(dummy).forEach(([key, value]) => {
                    const el = document.querySelector(`[data-stat="${key}"]`);
                    if(el) el.textContent = value;
                });
                document.querySelectorAll('.animate-pulse').forEach(card => card.classList.remove('animate-pulse'));
            }
        }

        loadStats();
        setInterval(loadStats, 60000); // Update setiap 1 menit

        // Demo Modal
        function openDemoModal() {
            const registerUrl = "{{ Route::has('register') ? route('register') : '#' }}";
            
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black/80 z-[9999] flex items-center justify-center p-4 backdrop-blur-sm';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl relative" data-aos="zoom-in">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                            <i class="fas fa-play-circle mr-3"></i>Demo AlumniTrace
                        </h2>
                        <button onclick="this.closest('.fixed').remove()" class="text-2xl hover:text-red-500 transition-colors">&times;</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                        <div class="space-y-4">
                            <div class="w-full h-48 bg-primary-100 dark:bg-primary-900/20 rounded-2xl flex items-center justify-center text-primary-600">
                                <i class="fas fa-desktop fa-3x"></i>
                            </div>
                            <h3 class="text-xl font-bold">Dashboard Admin</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola ribuan data alumni dengan sistem filter cerdas dan laporan otomatis.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="w-full h-48 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl flex items-center justify-center text-emerald-600">
                                <i class="fas fa-search fa-3x"></i>
                            </div>
                            <h3 class="text-xl font-bold">Pencarian Lanjutan</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Cari alumni berdasarkan tahun lulus, perusahaan, atau kompetensi spesifik.</p>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
                        <a href="${registerUrl}" class="inline-flex items-center px-8 py-4 bg-primary-600 text-white rounded-2xl font-bold hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl">
                            <i class="fas fa-rocket mr-3"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
    </script>
</body>
</html>