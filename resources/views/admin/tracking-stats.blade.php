@extends('layouts.admin')

@section('title', 'Tracking Stats')

@section('content')
<div class="space-y-8 pb-8">

    {{-- 1. HEADER SECTION --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-gray-900 dark:text-white">
                Tracking Progress
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Persentase keberhasilan tracking alumni</p>
        </div>
        <div class="flex items-center w-fit gap-2 text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 px-4 py-2 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <i class="far fa-calendar-alt"></i>
            <span id="currentDate"></span>
        </div>
    </div>

    {{-- 2. SUCCESS RATE HERO SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Success Rate Card --}}
        <div class="lg:col-span-1 glass-card rounded-2xl p-6 lg:p-8 bg-gradient-to-br from-primary-600 to-indigo-700 text-white border-0" data-aos="fade-up">
            <div class="text-center">
                <h2 class="text-lg lg:text-xl font-bold mb-4">Tracking Success Rate</h2>
                <div class="relative w-40 h-40 mx-auto mb-4">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="8"/>
                        <circle cx="50" cy="50" r="45" fill="none" stroke="white" stroke-width="8" stroke-linecap="round"
                            stroke-dasharray="{{ $stats['success_rate'] * 2.83 }} 283"
                            class="transition-all duration-1000"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-4xl lg:text-5xl font-black">{{ $stats['success_rate'] }}%</span>
                    </div>
                </div>
                <p class="text-primary-100 text-sm font-medium">
                    {{ $stats['identified'] }} dari {{ $stats['total_alumni'] }} alumni berhasil diidentifikasi
                </p>
            </div>
        </div>

        {{-- Stats Breakdown Cards --}}
        <div class="lg:col-span-2 grid grid-cols-2 gap-4">
            @php
                $statusCards = [
                    ['label' => 'Teridentifikasi', 'key' => 'identified', 'icon' => 'fa-check-circle', 'color' => 'emerald', 'from' => 'from-emerald-500', 'to' => 'to-green-600', 'desc' => 'Berhasil menemukan pekerjaan'],
                    ['label' => 'Perlu Verifikasi', 'key' => 'needs_manual', 'icon' => 'fa-exclamation-triangle', 'color' => 'amber', 'from' => 'from-amber-500', 'to' => 'to-orange-600', 'desc' => 'Butuh konfirmasi manual'],
                    ['label' => 'Belum Diproses', 'key' => 'pending', 'icon' => 'fa-clock', 'color' => 'blue', 'from' => 'from-blue-500', 'to' => 'to-indigo-600', 'desc' => 'Menunggu antrian'],
                    ['label' => 'Rata-rata Confidence', 'key' => 'avg_confidence', 'icon' => 'fa-bullseye', 'color' => 'purple', 'from' => 'from-purple-500', 'to' => 'to-violet-600', 'desc' => 'Skor kepercayaan rata-rata', 'isPercent' => true],
                ];
            @endphp

            @foreach($statusCards as $card)
                @php 
                    $val = $stats[$card['key']] ?? 0;
                    if (isset($card['isPercent'])) {
                        $display = $val . '%';
                        $pct = $val;
                    } else {
                        $display = number_format($val);
                        $pct = $stats['total_alumni'] > 0 ? round(($val / $stats['total_alumni']) * 100, 1) : 0;
                    }
                @endphp
                <div class="glass-card rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $card['from'] }} {{ $card['to'] }} flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas {{ $card['icon'] }} text-sm"></i>
                        </div>
                        <span class="text-2xl lg:text-3xl font-black text-gray-800 dark:text-white">{{ $display }}</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-600 dark:text-gray-400">{{ $card['label'] }}</h3>
                    <p class="text-[10px] lg:text-xs text-gray-400 mt-1">{{ $card['desc'] }}</p>
                    <div class="mt-3 w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                        <div class="bg-gradient-to-r {{ $card['from'] }} {{ $card['to'] }} h-full rounded-full transition-all duration-1000" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- 3. TRACKING PROGRESS SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Progress Overview --}}
        <div class="glass-card rounded-2xl p-6 lg:p-8 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-right">
            <h2 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2 mb-6">
                <i class="fas fa-chart-pie text-primary-600"></i> Progress Overview
            </h2>
            <div class="relative h-[250px]">
                <canvas id="trackingChart"></canvas>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="space-y-6" data-aos="fade-left">
            <div class="glass-card rounded-2xl p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
<form action="{{ route('admin.alumni.bulk-track') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3.5 rounded-xl bg-primary-600 text-white hover:bg-primary-700 transition-all hover:shadow-lg">
                            <i class="fas fa-search"></i>
                            <span class="font-semibold text-sm">Jalankan Bulk Tracking</span>
                        </button>
                    </form>
                    <form action="{{ route('admin.alumni.bulk-pddikti-verify') }}" method="POST" id="pddiktiForm">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition-all hover:shadow-lg">
                            <i class="fas fa-university"></i>
                            <span class="font-semibold text-sm">Verifikasi PDDIKTI Massal</span>
                        </button>
                    </form>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition-all hover:shadow-lg">
                        <i class="fas fa-chart-line"></i>
                        <span class="font-semibold text-sm">Lihat Dashboard</span>
                    </a>
                    <a href="{{ route('admin.alumni.index') }}" class="flex items-center gap-3 p-3.5 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:border-primary-500 transition-all">
                        <i class="fas fa-users text-primary-600"></i>
                        <span class="font-semibold text-sm text-gray-700 dark:text-gray-300">Kelola Alumni</span>
                    </a>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Konfidensi Tinggi (≥70%)</h3>
                <div class="flex items-center justify-between p-4 rounded-xl bg-purple-50 dark:bg-purple-900/20">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Alumni Teridentifikasi</span>
                    <span class="font-bold text-purple-600 text-lg">{{ $stats['high_confidence'] }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. RECENT TRACKING ACTIVITIES --}}
    <div class="glass-card rounded-2xl overflow-hidden bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700" data-aos="fade-up">
        <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-history text-primary-600"></i> Aktivitas Tracking Terbaru
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Alumni</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Prodi</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Confidence</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Terakhir Tracking</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($recentTrackings ?? [] as $item)
                    <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/5 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-900 dark:text-white">{{ $item->nama }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $item->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $item->prodi ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($item->profile && $item->profile->status === 'identified')
                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 rounded-lg text-[10px] font-bold uppercase">
                                    Teridentifikasi
                                </span>
                            @elseif($item->profile && $item->profile->status === 'needs_manual')
                                <span class="px-2.5 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300 rounded-lg text-[10px] font-bold uppercase">
                                    Perlu Verifikasi
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 rounded-lg text-[10px] font-bold uppercase">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->profile && $item->profile->confidence)
                                <span class="font-bold text-gray-800 dark:text-white">{{ round($item->profile->confidence * 100) }}%</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            @if($item->profile && $item->profile->last_tracked_at)
                                {{ $item->profile->last_tracked_at->diffForHumans() }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-search text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada aktivitas tracking</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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

    // PDDIKTI Bulk Verify Handler
    document.getElementById('pddiktiForm')?.addEventListener('submit', function(e) {
        if (!confirm('Verifikasi PDDIKTI untuk semua alumni yang belum/perlu diverifikasi?')) {
            e.preventDefault();
            return false;
        }
    });

    // Doughnut Chart
    const ctx = document.getElementById('trackingChart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Teridentifikasi', 'Perlu Verifikasi', 'Belum Diproses', 'Belum Tracking'],
                datasets: [{
                    data: [
                        {{ $stats['identified'] ?? 0 }}, 
                        {{ $stats['needs_manual'] ?? 0 }}, 
                        {{ $stats['pending'] ?? 0 }}, 
                        {{ $stats['untracked'] ?? 0 }}
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#9ca3af'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { 
                        position: 'bottom', 
                        labels: { 
                            padding: 20, 
                            font: { weight: 'bold' },
                            usePointStyle: true
                        } 
                    }
                }
            }
        });
    }
</script>
@endsection
