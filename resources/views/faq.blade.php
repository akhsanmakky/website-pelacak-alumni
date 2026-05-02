<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ - AlumniTrace</title>
    
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
    
    <style>
        .glass-nav { @apply bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border-b border-white/20 shadow-lg; }
        .glass-card { @apply bg-white/60 dark:bg-gray-900/60 backdrop-blur-xl border border-white/20 shadow-2xl; }
        .hero-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); }
        .blob { @apply absolute w-[300px] h-[300px] rounded-full blur-[50px] -z-10 opacity-30; background: #8b5cf6; animation: move 10s infinite alternate; }
        @keyframes move { from { transform: translate(0, 0); } to { transform: translate(100px, 50px); } }
        details summary { @apply cursor-pointer font-semibold; }
        details[open] summary { @apply text-primary-600; }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

    <!-- Navbar (matches welcome) -->
    <nav class="glass-nav fixed w-full z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="p-2 bg-primary-600 rounded-lg text-white group-hover:rotate-12 transition-transform">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent">
                        AlumniTrace
                    </span>
                </a>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="hover:text-primary-600 font-medium transition-colors">Home</a>
                    <a href="#features" class="hover:text-primary-600 font-medium transition-colors">Fitur</a>
                    <a href="/stats" class="hover:text-primary-600 font-medium transition-colors">Statistik</a>
                    <a href="/faq" class="text-primary-600 font-bold transition-colors">FAQ</a>
                    
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
                
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-32 pb-20 lg:pt-48 lg:pb-32 hero-gradient">
        <div class="blob top-20 left-10"></div>
        <div class="blob bottom-10 right-10" style="animation-delay: -5s"></div>
        
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 text-white leading-tight">
                <i class="fas fa-question-circle text-amber-400 mr-4"></i>
                Pertanyaan yang Sering <span class="text-amber-300">Ditanyakan</span>
            </h1>
            <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan jawaban atas pertanyaan umum tentang AlumniTrace dan sistem pelacakan karir.
            </p>
            <a href="#faq" class="group inline-flex items-center px-8 py-4 bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl font-bold text-white hover:bg-white/30 transition-all hover:shadow-2xl">
                Lihat Jawaban <i class="fas fa-chevron-down ml-2 group-hover:translate-y-1 transition-transform"></i>
            </a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 relative">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Search -->
            <div class="glass-card p-8 rounded-3xl mb-12 text-center" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-search text-3xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-2">Cari Jawaban Cepat</h3>
                    <input type="text" id="faqSearch" placeholder="Ketik kata kunci..." class="w-full px-6 py-4 rounded-2xl bg-white/50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 text-lg focus:ring-2 ring-primary-500 focus:border-transparent transition-all">
                </div>
            </div>

            <!-- FAQ Accordion -->
            <div class="space-y-4">
                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="100">
                    <details class="faq-item">
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Apa itu AlumniTrace?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                AlumniTrace adalah platform modern untuk pelacakan karir alumni yang menyediakan dashboard admin lengkap, analisis data real-time, integrasi PDDikti, dan fitur ekspor laporan Excel. Dirancang untuk institusi pendidikan memantau kesuksesan alumni secara komprehensif.
                            </p>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="200">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Bagaimana cara mendaftar sebagai admin?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                Klik tombol <span class="font-bold text-primary-600">"Daftar"</span> di pojok kanan atas, isi formulir registrasi dengan data admin institusi Anda. Setelah verifikasi email, akses dashboard di <code class="bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-lg font-mono text-sm">/dashboard</code>.
                            </p>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-xl font-medium hover:bg-primary-700 transition-all">
                                Daftar Sekarang <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="300">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Apa data yang harus diinput untuk alumni?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                Data minimal: Nama, NIM, Program Studi, Tahun Lulus, Email. Opsional: Tempat Kerja, Posisi, Status Karir (Bekerja, Wirausaha, Studi Lanjut). Sistem akan otomatis validasi NIM via PDDikti API.
                            </p>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="400">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Apakah data alumni aman dan privasi terjaga?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                <span class="font-bold text-green-600">100% Aman</span>. Menggunakan enkripsi Laravel, GDPR-compliant, data disimpan di server secure. Alumni bisa hapus data kapan saja. Tidak ada data dijual ke pihak ketiga.
                            </p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                <li><i class="fas fa-lock text-green-500 mr-2"></i> Enkripsi AES-256</li>
                                <li><i class="fas fa-shield-alt text-green-500 mr-2"></i> Auth 2FA ready</li>
                                <li><i class="fas fa-trash text-green-500 mr-2"></i> Self-delete option</li>
                            </ul>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="500">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Bagaimana statistik alumni diperoleh?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                Statistik diambil dari data yang diinput admin + validasi otomatis via <strong>PDDikti API</strong>. Grafik Chart.js menampilkan distribusi karir secara visual (Bekerja, Wirausaha, dll.).
                            </p>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="600">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Apa itu fitur PDDikti Sync?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                Fitur premium yang mencocokkan NIM alumni dengan database PDDikti pusat untuk validasi status lulusan. Status: <span class="font-mono px-2 py-1 bg-emerald-100 text-emerald-800 rounded">Verified</span>, <span class="font-mono px-2 py-1 bg-amber-100 text-amber-800 rounded">Pending</span>, atau <span class="font-mono px-2 py-1 bg-red-100 text-red-800 rounded">Not Found</span>.
                            </p>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="700">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Bisakah ekspor data ke Excel?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                <span class="font-bold text-green-600">Ya!</span> Fitur export Excel lengkap dengan filter (tahun, status karir, prodi). File otomatis diformat dengan chart summary dan statistik.
                            </p>
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                                <div class="text-center p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl">
                                    <i class="fas fa-file-excel text-emerald-500 text-xl mb-1"></i>
                                    <div>Excel Export</div>
                                </div>
                                <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                    <i class="fas fa-filter text-blue-500 text-xl mb-1"></i>
                                    <div>Advanced Filter</div>
                                </div>
                                <div class="text-center p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl">
                                    <i class="fas fa-chart-bar text-indigo-500 text-xl mb-1"></i>
                                    <div>Summary Chart</div>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="800">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Apa fitur admin dashboard?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                Dashboard lengkap: grafik distribusi karir, stats real-time, pencarian alumni, validasi PDDikti, CRUD lengkap, export Excel.
                            </p>
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWY1Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzY2NjY2NiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+U2RhdGFiYXJkIEFkbWluIExhbmdzYW5nPC90ZXh0Pjwvc3ZnPg==" alt="Dashboard Preview" class="w-full rounded-2xl shadow-lg mt-4">
                        </div>
                    </details>
                </div>

                <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="900">
                    <details>
                        <summary class="flex items-center justify-between py-4 cursor-pointer group">
                            <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">
                                Bagaimana menghubungi support?
                            </span>
                            <i class="fas fa-chevron-down text-xl text-gray-400 group-open:-rotate-180 transition-transform duration-200 ease-in-out"></i>
                        </summary>
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid md:grid-cols-2 gap-6 text-center">
                                <div class="p-6 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl">
                                    <i class="fas fa-envelope text-3xl text-emerald-500 mb-3"></i>
                                    <h4 class="font-bold text-lg mb-1">Email</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">support@alumnitrace.id</p>
                                </div>
                                <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-2xl">
                                    <i class="fas fa-whatsapp text-3xl text-green-500 mb-3"></i>
                                    <h4 class="font-bold text-lg mb-1">WhatsApp</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">+62 812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="glass-card p-12 rounded-3xl mt-16 text-center" data-aos="fade-up" data-aos-delay="1000">
                <h2 class="text-3xl font-bold mb-4 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                    Masih Ada Pertanyaan?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                    Hubungi tim support kami atau mulai sekarang dengan dashboard gratis.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-gradient-to-r from-primary-600 to-indigo-600 text-white rounded-2xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all">
                        Mulai Gratis <i class="fas fa-rocket ml-2"></i>
                    </a>
                    <a href="mailto:support@alumnitrace.id" class="px-10 py-4 border-2 border-gray-200 dark:border-gray-700 rounded-2xl font-bold text-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                        <i class="fas fa-envelope mr-2"></i> Email Support
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (matches welcome) -->
    <footer class="bg-gray-950 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-6">
                <div class="p-2 bg-primary-600 rounded-lg text-white">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="text-xl font-bold text-white tracking-tight">AlumniTrace</span>
            </div>
            <nav class="flex flex-wrap justify-center gap-6 mb-8 text-sm">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <a href="/faq" class="text-primary-400 font-semibold">FAQ</a>
                <a href="/stats" class="hover:text-white transition-colors">Statistik</a>
                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a>
            </nav>
            <div class="text-sm">
                &copy; 2026 AlumniTrace System. All rights reserved. | <a href="/privacy" class="hover:text-primary-400">Privasi</a> | <a href="/terms" class="hover:text-primary-400">Syarat</a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-2xl');
            } else {
                nav.classList.remove('shadow-2xl');
            }
        });

        // FAQ Search
        document.getElementById('faqSearch').addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            document.querySelectorAll('.faq-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(search) ? 'block' : 'none';
            });
        });

        // Smooth open animation
        document.querySelectorAll('details').forEach(detail => {
            detail.addEventListener('toggle', () => {
                detail.classList.toggle('open');
            });
        });
    </script>
</body>
</html>
