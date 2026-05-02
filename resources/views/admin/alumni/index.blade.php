@extends('layouts.admin')

@section('title', 'Data Alumni')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-12">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-extrabold mb-3 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                    <i class="fas fa-users mr-4"></i>Data Alumni
                </h1>
                @if (session('success'))
                    <div class="inline-flex items-center px-6 py-3 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-2xl text-green-800 dark:text-green-200 font-bold max-w-md mx-auto lg:mx-0">
                        <i class="fas fa-check-circle mr-3"></i>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.alumni.create') }}" class="px-8 py-4 bg-gradient-to-r from-primary-600 to-indigo-600 text-white rounded-2xl font-bold hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl flex items-center">
                    <i class="fas fa-plus mr-3"></i>Tambah Alumni
                </a>
                <a href="{{ route('admin.alumni.export') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-2xl font-bold hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl flex items-center">
                    <i class="fas fa-download mr-3"></i>Export Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
        <div class="glass-card p-8 rounded-3xl hover:shadow-2xl hover:-translate-y-2 transition-all group" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-building text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-blue-600 ml-auto counter" data-target="{{ $stats['pns'] ?? 0 }}">0</span>
            </div>
            <h3 class="text-2xl font-bold mb-2">PNS</h3>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full shadow-lg transition-all" style="width: 80%"></div>
            </div>
        </div>

        <div class="glass-card p-8 rounded-3xl hover:shadow-2xl hover:-translate-y-2 transition-all group" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-industry text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-green-600 ml-auto counter" data-target="{{ $stats['swasta'] ?? 0 }}">0</span>
            </div>
            <h3 class="text-2xl font-bold mb-2">Swasta</h3>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-3 rounded-full shadow-lg transition-all" style="width: 65%"></div>
            </div>
        </div>

        <div class="glass-card p-8 rounded-3xl hover:shadow-2xl hover:-translate-y-2 transition-all group" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-lightbulb text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-amber-600 ml-auto counter" data-target="{{ $stats['wirausaha'] ?? 0 }}">0</span>
            </div>
            <h3 class="text-2xl font-bold mb-2">Wirausaha</h3>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 h-3 rounded-full shadow-lg transition-all" style="width: 45%"></div>
            </div>
        </div>

        <div class="glass-card p-8 rounded-3xl hover:shadow-2xl hover:-translate-y-2 transition-all group col-span-1 md:col-span-2 xl:col-span-1" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-indigo-600 ml-auto counter" data-target="{{ $stats['total'] ?? 0 }}">0</span>
            </div>
            <h3 class="text-2xl font-bold mb-2">Total Alumni</h3>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-3 rounded-full shadow-lg transition-all" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Chart & Search -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2 glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="500">
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-white/20">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                    <i class="fas fa-chart-pie mr-3"></i>Statistik Alumni
                </h2>
            </div>
            <div class="h-80 lg:h-96">
                <canvas id="alumniChart"></canvas>
            </div>
        </div>

        <!-- Search Form -->
        <div class="glass-card p-8 rounded-3xl" data-aos="fade-up" data-aos-delay="600">
            <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                <i class="fas fa-search mr-3"></i>Pencarian Lanjutan
            </h3>
            <form method="GET" action="{{ route('admin.alumni.index') }}" class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama</label>
                    <input type="text" name="search_nama" class="w-full input-glass px-4 py-3 rounded-2xl focus:ring-2 ring-primary-500/30" placeholder="Cari nama alumni..." value="{{ $searchNama ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" name="search_email" class="w-full input-glass px-4 py-3 rounded-2xl focus:ring-2 ring-primary-500/30" placeholder="alumni@email.com" value="{{ $searchEmail ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tempat Kerja</label>
                    <input type="text" name="search_tempat_kerja" class="w-full input-glass px-4 py-3 rounded-2xl focus:ring-2 ring-primary-500/30" placeholder="PT / Instansi" value="{{ $searchTempatKerja ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Posisi</label>
                    <input type="text" name="search_posisi" class="w-full input-glass px-4 py-3 rounded-2xl focus:ring-2 ring-primary-500/30" placeholder="Manager / Staff" value="{{ $searchPosisi ?? '' }}">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-600 to-indigo-600 text-white rounded-2xl font-bold hover:shadow-2xl hover:-translate-y-1 transition-all shadow-lg">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    <a href="{{ route('admin.alumni.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-800 border rounded-2xl font-bold hover:shadow-lg hover:-translate-y-1 transition-all flex items-center justify-center">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Alumni Table -->
    <div class="glass-card rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="700">
        <div class="p-8 border-b border-white/20 bg-gradient-to-r from-primary-50 to-indigo-50 dark:from-gray-900/50 dark:to-slate-900/50">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                    Daftar Alumni
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('admin.alumni.export') }}" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-2xl font-bold hover:shadow-xl hover:-translate-y-1 transition-all shadow-lg flex items-center">
                        <i class="fas fa-download mr-2"></i>Export
                    </a>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm sticky top-0 z-10">
                    <tr>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">Nama</th>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">NIM</th>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">Prodi</th>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">Tahun Lulus</th>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">Status Karir</th>
                        <th class="px-8 py-6 text-left font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">PDDIKTI</th>
                        <th class="px-8 py-6 text-right font-bold text-xl text-gray-900 dark:text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($alumni as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all group">
                        <td class="px-8 py-8">
                            <div class="flex items-center">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg mr-6 shadow-lg group-hover:scale-105 transition-transform">
                                    {{ substr($item->nama, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-xl text-gray-900 dark:text-white">{{ $item->nama }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $item->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-8">
                            <code class="bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-xl font-bold text-lg block">{{ $item->nim }}</code>
                        </td>
                        <td class="px-8 py-8">
                            <span class="inline-flex px-6 py-3 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-2xl font-bold text-lg">
                                {{ $item->prodi ?? '-' }}
                            </span>
                        </td>
                        <td class="px-8 py-8">
                            <span class="px-6 py-3 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-2xl font-bold text-lg">
                                {{ $item->tahun_lulus ?? '-' }}
                            </span>
                        </td>
                        <td class="px-8 py-8">
                            @php
                                $statusMap = [
                                    'Bekerja' => ['success', 'fas fa-briefcase', '#10b981'],
                                    'Wirausaha' => ['warning', 'fas fa-lightbulb', '#f59e0b'],
                                    'Studi Lanjut' => ['info', 'fas fa-graduation-cap', '#06b6d4'],
                                    'Belum Diketahui' => ['gray', 'fas fa-question-circle', '#6b7280']
                                ];
                                $status = $item->status_karir ?? 'Belum Diketahui';
                                $statusData = $statusMap[$status] ?? $statusMap['Belum Diketahui'];
                            @endphp
                            <span class="inline-flex items-center px-6 py-3 bg-{{ $statusData[0] }}-100 dark:bg-{{ $statusData[0] }}-900/30 text-{{ $statusData[0] }}-800 dark:text-{{ $statusData[0] }}-200 rounded-2xl font-bold text-lg shadow-lg">
                                <i class="{{ $statusData[1] }} mr-2"></i>
                                {{ $status }}
                            </span>
                        </td>
                        <td class="px-8 py-8">
                            <span class="inline-flex items-center px-6 py-3 rounded-2xl font-bold text-lg shadow-lg
                                @if($item->pddikti_status == 'verified') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 @elseif($item->pddikti_status == 'pending') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 @elseif($item->pddikti_status == 'not_found') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 @else bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 @endif">
                                <i class="fas @if($item->pddikti_status == 'verified') fa-check-circle text-green-600 @elseif($item->pddikti_status == 'pending') fa-clock text-amber-600 @elseif($item->pddikti_status == 'not_found') fa-times-circle text-red-600 @else fa-minus text-gray-600 @endif mr-2"></i>
                                {{ ucfirst(str_replace('_', ' ', $item->pddikti_status ?? 'Pending')) }}
                            </span>
                            <form action="{{ route('admin.alumni.validate', $item) }}" method="POST" class="inline-block mt-3">
                                @csrf
                                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-primary-500 to-indigo-500 text-white rounded-xl font-bold hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md text-sm">
                                    <i class="fas fa-sync-alt mr-1"></i>Validasi
                                </button>
                            </form>
                        </td>
                        <td class="px-8 py-8 text-right">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.alumni.show', $item) }}" class="p-3 text-blue-600 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-800/50 rounded-2xl transition-all shadow-md hover:shadow-lg hover:-translate-y-1">
                                    <i class="fas fa-eye text-xl"></i>
                                </a>
                                <a href="{{ route('admin.alumni.edit', $item) }}" class="p-3 text-amber-600 bg-amber-100 dark:bg-amber-900/30 hover:bg-amber-200 dark:hover:bg-amber-800/50 rounded-2xl transition-all shadow-md hover:shadow-lg hover:-translate-y-1">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>
                                <form action="{{ route('admin.alumni.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus {{ $item->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-3 text-red-600 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-800/50 rounded-2xl transition-all shadow-md hover:shadow-lg hover:-translate-y-1">
                                        <i class="fas fa-trash text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-24 text-center">
                            <div class="flex flex-col items-center space-y-6">
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-3xl flex items-center justify-center shadow-xl">
                                    <i class="fas fa-users text-5xl text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Belum ada data alumni</h3>
                                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-md mx-auto">Mulai bangun database alumni Anda dengan menambahkan alumni pertama</p>
                                </div>
                                <a href="{{ route('admin.alumni.create') }}" class="px-10 py-5 bg-gradient-to-r from-primary-600 to-indigo-600 text-white rounded-3xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all">
                                    <i class="fas fa-plus mr-3"></i>Tambah Alumni Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($alumni->hasPages())
        <div class="p-8 border-t border-white/20 bg-gradient-to-r from-primary-50 to-indigo-50 dark:from-gray-900/50 dark:to-slate-900/50">
            <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                {{ $alumni->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter animations
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 150;
        let current = 0;
        const updateCounter = () => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            }
        };
        updateCounter();
    });

    // Pie Chart
    const ctx = document.getElementById('alumniChart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['PNS', 'Swasta', 'Wirausaha'],
                datasets: [{
                    data: [{{ $stats['pns'] ?? 0 }}, {{ $stats['swasta'] ?? 0 }}, {{ $stats['wirausaha'] ?? 0 }}],
                    backgroundColor: [
                        'rgb(59, 130, 246)',
                        'rgb(34, 197, 94)',
                        'rgb(251, 191, 36)'
                    ],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 15,
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 40,
                            usePointStyle: true,
                            font: { size: 16 }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 2500
                }
            }
        });
    }
});
</script>
@endsection
