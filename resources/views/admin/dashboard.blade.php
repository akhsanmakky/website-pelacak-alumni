@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div data-aos="fade-up" class="space-y-10">
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="p-4 bg-gradient-to-br from-primary-600 to-indigo-600 rounded-2xl text-white shadow-lg shadow-primary-500/20">
                <i class="fas fa-tachometer-alt text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    Dashboard Admin
                </h1>
                <p class="text-gray-600 dark:text-gray-400 font-medium">
                    Selamat datang kembali, <span class="text-primary-600 font-bold">{{ Auth::user()->name }}</span>!
                </p>
            </div>
        </div>
        
        <div class="hidden lg:block text-right">
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Status Sistem</p>
            <p class="text-green-500 flex items-center justify-end gap-2 font-bold">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                Aktif & Terpantau
            </p>
        </div>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        @php
            $cards = [
                ['label' => 'Total Alumni', 'key' => 'total_alumni', 'icon' => 'fa-users', 'color' => 'primary', 'gradient' => 'from-primary-600 to-indigo-600'],
                ['label' => 'Bekerja', 'key' => 'bekerja', 'icon' => 'fa-briefcase', 'color' => 'green', 'gradient' => 'from-green-500 to-emerald-600'],
                ['label' => 'Wirausaha', 'key' => 'wirausaha', 'icon' => 'fa-lightbulb', 'color' => 'amber', 'gradient' => 'from-amber-500 to-orange-500'],
                ['label' => 'Belum Diketahui', 'key' => 'belum_diketahui', 'icon' => 'fa-question-circle', 'color' => 'gray', 'gradient' => 'from-gray-500 to-slate-600'],
            ];
        @endphp

        @foreach($cards as $index => $card)
        <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="glass-card p-6 rounded-3xl h-full hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-l-4 border-{{ $card['color'] }}-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-{{ $card['color'] }}-600/10 rounded-xl flex items-center justify-center text-{{ $card['color'] }}-600">
                        <i class="fas {{ $card['icon'] }} text-xl"></i>
                    </div>
                    <span class="text-3xl font-black text-{{ $card['color'] }}-600 counter" data-target="{{ $stats[$card['key']] ?? 0 }}">0</span>
                </div>
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">{{ $card['label'] }}</h3>
                <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                    @php
                        $total = $stats['total_alumni'] ?? 1;
                        $value = $stats[$card['key']] ?? 0;
                        $percentage = ($card['key'] == 'total_alumni') ? 100 : round(($value / max($total, 1)) * 100, 1);
                    @endphp
                    <div class="bg-gradient-to-r {{ $card['gradient'] }} h-full rounded-full transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                </div>
                <p class="text-xs mt-2 font-semibold text-gray-500">{{ $percentage }}% dari total populasi</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2" data-aos="fade-right">
            <div class="glass-card p-8 rounded-3xl h-full">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        <i class="fas fa-chart-pie mr-2 text-primary-600"></i> Distribusi Karir
                    </h2>
                    <select class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm font-bold focus:ring-primary-500 cursor-pointer">
                        <option>Semua Angkatan</option>
                        <option>2025</option>
                        <option>2024</option>
                    </select>
                </div>
                <div class="relative h-80 md:h-96 lg:h-[28rem]">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="space-y-6" data-aos="fade-left">
            <div class="glass-card p-8 rounded-3xl shadow-sm">
                <h3 class="text-xl font-bold mb-6 text-gray-800 dark:text-white">Aksi Cepat</h3>
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.alumni.create') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-primary-600 text-white hover:bg-primary-700 transition-all hover:scale-[1.02] shadow-lg shadow-primary-600/20">
                        <i class="fas fa-user-plus text-xl"></i>
                        <span class="font-bold">Tambah Alumni Baru</span>
                    </a>
                    <a href="{{ route('admin.alumni.export') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-600 text-white hover:bg-emerald-700 transition-all hover:scale-[1.02] shadow-lg shadow-emerald-600/20">
                        <i class="fas fa-file-export text-xl"></i>
                        <span class="font-bold">Export Laporan Excel</span>
                    </a>
                    <button onclick="validateAll()" class="flex items-center gap-4 p-4 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:border-primary-500 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <span class="font-bold text-gray-700 dark:text-gray-200">Sync PDDikti</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card rounded-3xl overflow-hidden shadow-sm" data-aos="fade-up">
        <div class="p-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                <i class="fas fa-list-ul mr-2 text-primary-600"></i> Update Terbaru
            </h2>
            <a href="{{ route('admin.alumni.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                Lihat Semua <i class="fas fa-external-link-alt text-xs"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 dark:bg-gray-800/50 text-gray-500 text-xs uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-8 py-4">Informasi Alumni</th>
                        <th class="px-8 py-4">Program Studi</th>
                        <th class="px-8 py-4 text-center">Tahun</th>
                        <th class="px-8 py-4">Status Karir</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($recentAlumni ?? [] as $alumni)
                    <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/10 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-400 to-indigo-500 flex items-center justify-center text-white font-black shadow-md">
                                    {{ strtoupper(substr($alumni->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition-colors">{{ $alumni->nama }}</p>
                                    <p class="text-xs text-gray-500 font-mono">{{ $alumni->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 italic">
                                {{ $alumni->prodi ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-lg text-xs font-bold text-gray-600 dark:text-gray-400">
                                {{ $alumni->tahun_lulus }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            @php
                                $statusClasses = [
                                    'Bekerja' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'Wirausaha' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                    'Studi Lanjut' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                ];
                                $class = $statusClasses[$alumni->status_karir] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300';
                            @endphp
                            <span class="px-3 py-1.5 {{ $class }} rounded-full text-[10px] font-black uppercase tracking-wider">
                                {{ $alumni->status_karir ?? 'Belum Update' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.alumni.show', $alumni) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('admin.alumni.edit', $alumni) }}" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-600 hover:text-white transition-all">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="opacity-40 mb-4 text-6xl">📂</div>
                            <p class="text-gray-500 font-bold">Belum ada data alumni yang masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Optimized Counter Animation
    const animateCounters = () => {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1500;
            const step = target / (duration / 16);
            let current = 0;

            const update = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            };
            update();
        });
    };

    // Improved Chart.js with datalabels
    const initChart = () => {
        const ctx = document.getElementById('statusChart')?.getContext('2d');
        if (!ctx) return;

        // Register datalabels plugin
        Chart.register(ChartDataLabels);

        const total = {{ ($stats['bekerja'] ?? 0) + ($stats['wirausaha'] ?? 0) + ($stats['studi_lanjut'] ?? 0) + ($stats['belum_diketahui'] ?? 0) }};
        const data = [
            {{ $stats['bekerja'] ?? 0 }},
            {{ $stats['wirausaha'] ?? 0 }},
            {{ $stats['studi_lanjut'] ?? 0 }},
            {{ $stats['belum_diketahui'] ?? 0 }}
        ];

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Bekerja', 'Wirausaha', 'Studi Lanjut', 'Belum Update'],
                datasets: [{
                    data: data,
                    backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#94a3b8'],
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 6,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 25,
                            font: {
                                family: 'Figtree',
                                weight: '600',
                                size: window.innerWidth < 768 ? 11 : 14
                            },
                            pointStyle: 'circle',
                            color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#475569'
                        }
                    },
                    datalabels: {
                        color: 'white',
                        font: {
                            weight: 'bold',
                            family: 'Figtree',
                            size: 20
                        },
                        formatter: (value, ctx) => {
                            if (ctx.datasetIndex === 0 && ctx.dataIndex === 0) {
                                return total.toLocaleString();
                            }
                            const sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / sum) * 100).toFixed(0) + '%';
                            return value > 0 ? percentage : '';
                        },
                        anchor: 'end',
                        align: (ctx) => ctx.datasetIndex === 0 ? 'center' : 270
                    },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((ctx.parsed / total) * 100).toFixed(1);
                                return ctx.label + ': ' + ctx.parsed.toLocaleString() + ' (' + percentage + '%)';
                            }
                        },
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: { family: 'Figtree', weight: 'bold' },
                        bodyFont: { family: 'Figtree' }
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            },
            plugins: [ChartDataLabels]
        });

        // Resize observer for responsive font
        new ResizeObserver(() => {
            window.dispatchEvent(new Event('resize'));
        }).observe(ctx.canvas);
    };

    animateCounters();
    initChart();
});

        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
        <script>
function validateAll() {
    Swal.fire({
        title: 'Sync PDDikti?',
        text: "Proses ini akan mencocokkan NIM alumni dengan database pusat.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        confirmButtonText: 'Ya, Jalankan Sync!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Mohon Tunggu', 'Fitur integrasi API sedang diinisialisasi...', 'info');
        }
    });
}
</script>
@endsection
