@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8 pb-8">

    {{-- 1. HEADER SECTION --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-gray-900 dark:text-white">
                Selamat Datang, <span class="text-primary-600">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Ringkasan data alumni terkini</p>
        </div>
        <div class="flex items-center w-fit gap-2 text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <i class="far fa-calendar-alt"></i>
            <span id="currentDate"></span>
        </div>
    </div>

    {{-- 2. MAIN STATS CARDS - Task Exact Labels --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6" data-aos="fade-up">
        @php
            $trackCards = [
                ['label' => 'Teridentifikasi',     'key' => 'teridentifikasi',  'icon' => 'fa-check-circle',   'color' => 'emerald', 'from' => 'from-emerald-500', 'to' => 'to-green-600'],
                ['label' => 'Perlu Verifikasi',    'key' => 'perlu_verifikasi', 'icon' => 'fa-exclamation-triangle', 'color' => 'amber',  'from' => 'from-amber-500',  'to' => 'to-orange-600'],
                ['label' => 'Belum Ditemukan',     'key' => 'belum_ditemukan',  'icon' => 'fa-search',         'color' => 'blue',    'from' => 'from-blue-500',   'to' => 'to-indigo-600'],
                ['label' => 'Tidak Valid (PDDIKTI)', 'key' => 'tidak_valid',     'icon' => 'fa-times-circle',   'color' => 'red',     'from' => 'from-red-500',    'to' => 'to-rose-600'],
            ];
            $trackTotal = max(($stats['teridentifikasi'] ?? 0) + ($stats['perlu_verifikasi'] ?? 0) + ($stats['belum_ditemukan'] ?? 0) + ($stats['tidak_valid'] ?? 0), 1);
        @endphp

        @foreach($trackCards as $card)
            @php 
                $val = $stats[$card['key']] ?? 0; 
                $pct = round(($val / $trackTotal) * 100, 1); 
            @endphp
            <div class="glass-card rounded-2xl p-5 lg:p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br {{ $card['from'] }} {{ $card['to'] }} flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                        <i class="fas {{ $card['icon'] }} text-sm lg:text-base"></i>
                    </div>
                    <span class="text-2xl lg:text-3xl font-black text-gray-800 dark:text-white counter" data-target="{{ $val }}">0</span>
                </div>
                <h3 class="text-sm lg:text-base font-bold text-gray-600 dark:text-gray-400">{{ $card['label'] }}</h3>
                <div class="mt-3 w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="bg-gradient-to-r {{ $card['from'] }} {{ $card['to'] }} h-full rounded-full transition-all duration-1000" style="width: {{ $pct }}%"></div>
                </div>
                <p class="text-[10px] lg:text-xs text-gray-400 mt-1.5 font-medium">{{ $pct }}% tracking progress</p>
            </div>
        @endforeach
    </div>

    {{-- 3. PDDIKTI VALIDATION STATS --}}
    <div class="glass-card rounded-2xl p-6 lg:p-8 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-shield-alt text-primary-600"></i> Status Validasi PDDIKTI
            </h2>
            <a href="{{ route('admin.alumni.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $pddiktiCards = [
                    ['label' => 'Total Alumni',      'key' => 'pddikti_total',    'icon' => 'fa-users',          'color' => 'gray',    'from' => 'from-gray-500',    'to' => 'to-gray-600'],
                    ['label' => 'Terverifikasi',     'key' => 'pddikti_verified', 'icon' => 'fa-check-circle',   'color' => 'green',   'from' => 'from-green-500',   'to' => 'to-emerald-600'],
                    ['label' => 'Tidak Ditemukan',   'key' => 'pddikti_notfound', 'icon' => 'fa-times-circle',   'color' => 'red',     'from' => 'from-red-500',     'to' => 'to-rose-600'],
                    ['label' => 'Menunggu / Error',  'key' => 'pddikti_pending',  'icon' => 'fa-clock',          'color' => 'amber',   'from' => 'from-amber-500',   'to' => 'to-orange-600'],
                ];
                $pddiktiTotal = max($stats['pddikti_total'] ?? 1, 1);
            @endphp
            @foreach($pddiktiCards as $pc)
                @php $val = $stats[$pc['key']] ?? 0; $pct = round(($val / $pddiktiTotal) * 100, 1); @endphp
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-5 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br {{ $pc['from'] }} {{ $pc['to'] }} flex items-center justify-center text-white shadow-md">
                            <i class="fas {{ $pc['icon'] }} text-xs"></i>
                        </div>
                        <span class="text-xl font-black text-gray-800 dark:text-white">{{ $val }}</span>
                    </div>
                    <h4 class="text-sm font-bold text-gray-600 dark:text-gray-400">{{ $pc['label'] }}</h4>
                    <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                        <div class="bg-gradient-to-r {{ $pc['from'] }} {{ $pc['to'] }} h-full rounded-full transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 4. CHART & QUICK ACTIONS SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 glass-card rounded-2xl p-6 lg:p-8 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-right">
            <h2 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2 mb-6">
                <i class="fas fa-chart-pie text-primary-600"></i> Distribusi Karir Alumni
            </h2>
            <div class="relative h-[300px] sm:h-[350px]">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="space-y-6" data-aos="fade-left">
            <div class="glass-card rounded-2xl p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.alumni.create') }}" class="flex items-center gap-3 p-3.5 rounded-xl bg-primary-600 text-white hover:bg-primary-700 transition-all hover:shadow-lg">
                        <i class="fas fa-user-plus"></i>
                        <span class="font-semibold text-sm">Tambah Alumni</span>
                    </a>
                    <a href="{{ route('admin.alumni.export') }}" class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition-all hover:shadow-lg">
                        <i class="fas fa-file-excel"></i>
                        <span class="font-semibold text-sm">Export Excel</span>
                    </a>
                    <form action="{{ route('admin.alumni.bulk-pddikti-verify') }}" method="POST" id="pddiktiForm">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-3 p-4 rounded-xl bg-gradient-to-r from-purple-500 to-purple-700 text-white hover:from-purple-600 hover:to-purple-800 transition-all duration-300 hover:shadow-xl font-bold text-sm shadow-lg relative overflow-hidden" id="pddiktiBtn">
                            <i class="fas fa-university text-lg"></i>
                            <span class="pddikti-text">Verifikasi PDDIKTI Massal</span>
                            <span class="pddikti-loading hidden">⏳ Memverifikasi...</span>
                        </button>
                    </form>
                    <a href="{{ route('admin.alumni.index') }}" class="flex items-center gap-3 p-3.5 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:border-primary-500 transition-all">
                        <i class="fas fa-search text-primary-600"></i>
                        <span class="font-semibold text-sm text-gray-700 dark:text-gray-300">Cari Alumni</span>
                    </a>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Status Lainnya</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Studi Lanjut</span>
                        <span class="font-bold text-blue-600">{{ $stats['studi_lanjut'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-100 dark:bg-gray-700">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Belum Diketahui</span>
                        <span class="font-bold text-gray-600">{{ $stats['belum_diketahui'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 5. TABLES SECTION --}}
    <div class="space-y-6">
        {{-- Alumni Terbaru --}}
        <div class="glass-card rounded-2xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-up">
            <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-clock-rotate-left text-primary-600"></i> Alumni Terbaru
                </h2>
                <a href="{{ route('admin.alumni.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                    Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Alumni</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Prodi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Lulus</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($recentAlumni ?? [] as $alumni)
                        <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($alumni->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900 dark:text-white">{{ $alumni->nama }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $alumni->nim }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $alumni->prodi ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg text-xs font-bold">{{ $alumni->tahun_lulus }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 rounded-lg text-[10px] font-bold uppercase">
                                    {{ $alumni->status_karir ?? 'N/A' }}
                                </span>
                            </td>
<td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.alumni.validate', $alumni->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-purple-600 hover:text-purple-700 p-1" title="Verifikasi PDDIKTI" onclick="return confirm('Verifikasi {{ $alumni->nama }} di PDDIKTI?')">
                                            <i class="fas fa-university"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.alumni.show', $alumni->id) }}" class="text-primary-600 hover:text-primary-700"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada data alumni</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    // Set Current Date
    const now = new Date();
    document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', { 
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
    });

    // Counter Animation
    document.querySelectorAll('.counter').forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const update = () => {
            const current = +counter.innerText.replace(/\./g, '');
            const inc = target / 50;
            if (current < target) {
                counter.innerText = Math.ceil(current + inc).toLocaleString('id-ID');
                setTimeout(update, 20);
            } else {
                counter.innerText = target.toLocaleString('id-ID');
            }
        };
        update();
    });

    // PDDIKTI Bulk Verify Handler
    document.getElementById('pddiktiForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('pddiktiBtn');
        const text = btn.querySelector('.pddikti-text');
        const loading = btn.querySelector('.pddikti-loading');
        
        if (!confirm('Verifikasi PDDIKTI untuk semua alumni yang belum/perlu diverifikasi?')) {
            e.preventDefault();
            return false;
        }
        
        // Loading state
        btn.disabled = true;
        text.classList.add('hidden');
        loading.classList.remove('hidden');
        
        // Re-enable after 30s timeout (in case of long process)
        setTimeout(() => {
            btn.disabled = false;
            text.classList.remove('hidden');
            loading.classList.add('hidden');
        }, 30000);
    });

    // Doughnut Chart
    const ctx = document.getElementById('statusChart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Bekerja', 'Wirausaha', 'Studi Lanjut', 'Lainnya'],
                datasets: [{
                    data: [
                        {{ $stats['bekerja'] ?? 0 }}, 
                        {{ $stats['wirausaha'] ?? 0 }}, 
                        {{ $stats['studi_lanjut'] ?? 0 }}, 
                        {{ $stats['belum_diketahui'] ?? 0 }}
                    ],
                    backgroundColor: ['#3b82f6', '#f59e0b', '#06b6d4', '#9ca3af'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 20, font: { weight: 'bold' } } }
                }
            }
        });
    }
</script>
@endsection
