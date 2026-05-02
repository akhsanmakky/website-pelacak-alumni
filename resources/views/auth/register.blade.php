<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - AlumniTrace</title>
    
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
        .glass-nav { @apply bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border-b border-white/20; }
        .glass-card { @apply bg-white/60 dark:bg-gray-900/60 backdrop-blur-xl border border-white/30 dark:border-gray-700/50 shadow-2xl; }
        .hero-gradient {
            background: radial-gradient(circle at top right, #8b5cf6, transparent),
                        radial-gradient(circle at bottom left, #3b82f6, transparent),
                        linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }
        .blob {
            position: absolute; width: 300px; height: 300px; background: rgba(139, 92, 246, 0.3);
            filter: blur(50px); border-radius: 50%; z-index: -1; animation: move 10s infinite alternate;
        }
        @keyframes move { from { transform: translate(0, 0); } to { transform: translate(100px, 50px); } }
        .input-glass { @apply bg-white/50 dark:bg-gray-800/50 border border-white/30 dark:border-gray-600/50 backdrop-blur-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition-all; }
    </style>
</head>
<body class="antialiased font-figtree bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <nav class="glass-nav fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="p-2 bg-primary-600 rounded-lg text-white group-hover:rotate-12 transition-transform">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-primary-600 to-indigo-500 bg-clip-text text-transparent">
                        AlumniTrace
                    </span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="hover:text-primary-600 font-medium transition-colors">Beranda</a>
                    <a href="{{ route('login') }}" class="bg-primary-600 text-white px-6 py-2.5 rounded-full font-bold hover:shadow-lg hover:shadow-primary-500/30 transition-all">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden pt-32 pb-20 lg:pt-48 lg:pb-32">
        <div class="blob top-20 left-10"></div>
        <div class="blob bottom-10 right-10" style="animation-delay: -5s"></div>
        
        <div class="max-w-md mx-auto px-4" data-aos="zoom-in" data-aos-duration="1000">
            <div class="glass-card p-10 rounded-3xl">
                <div class="text-center mb-10">
                    <div class="w-20 h-20 bg-primary-600/10 border-4 border-primary-600/20 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-plus text-primary-600 text-2xl"></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-extrabold mb-4 bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-200 bg-clip-text text-transparent">
                        Buat Akun Baru
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">Daftar untuk mengakses panel AlumniTrace</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div data-aos="fade-up" data-aos-delay="100">
                        <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Nama Lengkap</label>
                        <input id="name" 
                               type="text" 
                               class="w-full input-glass px-4 py-4 rounded-2xl text-lg @error('name') ring-2 ring-red-500 @enderror" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div data-aos="fade-up" data-aos-delay="150">
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Email</label>
                        <input id="email" 
                               type="email" 
                               class="w-full input-glass px-4 py-4 rounded-2xl text-lg @error('email') ring-2 ring-red-500 @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Password</label>
                        <input id="password" 
                               type="password" 
                               class="w-full input-glass px-4 py-4 rounded-2xl text-lg @error('password') ring-2 ring-red-500 @enderror" 
                               name="password" 
                               required
                               placeholder="Buat password yang kuat">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div data-aos="fade-up" data-aos-delay="250">
                        <label for="password-confirm" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Konfirmasi Password</label>
                        <input id="password-confirm" 
                               type="password" 
                               class="w-full input-glass px-4 py-4 rounded-2xl text-lg" 
                               name="password_confirmation" 
                               required
                               placeholder="Ulangi password Anda">
                    </div>

                    <button type="submit" 
                            data-aos="fade-up" 
                            data-aos-delay="300"
                            class="w-full bg-gradient-to-r from-primary-600 to-indigo-600 text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:from-primary-700 hover:to-indigo-700 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-user-plus mr-3"></i>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700 text-center" data-aos="fade-up" data-aos-delay="400">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-lg transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk ke Akun
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-950 text-gray-400 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 AlumniTrace System. All rights reserved. | Sistem Pelacakan Karir Alumni Modern</p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });

        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('py-4', 'shadow-2xl');
            } else {
                nav.classList.remove('py-4', 'shadow-2xl');
            }
        });
    </script>
</body>
</html>
