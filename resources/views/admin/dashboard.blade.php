
@extends('layouts.app')

@section('title', 'Dashboard - Pelacakan Alumni')

@section('content')
<div class="container-fluid px-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <i class="bi bi-speedometer2 fs-1 text-primary me-3"></i>
                <div>
                    <h1 class="mb-1">Dashboard</h1>
                    <p class="mb-0 text-muted">Selamat datang, {{ Auth::user()->name }}! Pantau perkembangan alumni Anda.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row mb-5 g-4">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 text-white shadow-lg border-0 pro-card-hover">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-gradient rounded-circle p-3">
                            <i class="bi bi-people-fill fs-2 text-white opacity-75"></i>
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold fs-4 mb-1 counter" data-target="{{ $stats['total_alumni'] ?? 0 }}">0</div>
                            <div class="text-white-50 small">Total Alumni</div>
                        </div>
                    </div>
                    @if(($stats['total_alumni'] ?? 0) > 0)
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100 text-white shadow-lg border-0 pro-card-hover" style="--bs-bg-opacity: 1; background-color: rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important; background: linear-gradient(135deg, #28a745, #20c997);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success bg-gradient rounded-circle p-3">
                            <i class="bi bi-briefcase-fill fs-2 text-white opacity-75"></i>
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold fs-4 mb-1 counter" data-target="{{ $stats['bekerja'] ?? 0 }}">0</div>
                            <div class="text-white-50 small">Bekerja</div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ ($stats['total_alumni'] ?? 1) > 0 ? round(($stats['bekerja'] ?? 0) / ($stats['total_alumni'] ?? 1) * 100, 1) : 0 }}%" aria-valuenow="{{ $stats['bekerja'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_alumni'] ?? 1 }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100 text-white shadow-lg border-0 pro-card-hover" style="background: linear-gradient(135deg, #17a2b8, #20c997);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-info bg-gradient rounded-circle p-3">
                            <i class="bi bi-lightbulb-fill fs-2 text-white opacity-75"></i>
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold fs-4 mb-1 counter" data-target="{{ $stats['wirausaha'] ?? 0 }}">0</div>
                            <div class="text-white-50 small">Wirausaha</div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ ($stats['total_alumni'] ?? 1) > 0 ? round(($stats['wirausaha'] ?? 0) / ($stats['total_alumni'] ?? 1) * 100, 1) : 0 }}%" aria-valuenow="{{ $stats['wirausaha'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_alumni'] ?? 1 }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100 text-white shadow-lg border-0 pro-card-hover" style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning bg-gradient rounded-circle p-3">
                            <i class="bi bi-question-circle-fill fs-2 text-white opacity-75"></i>
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold fs-4 mb-1 counter" data-target="{{ $stats['belum_diketahui'] ?? 0 }}">0</div>
                            <div class="text-white-50 small">Belum Diketahui</div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: {{ ($stats['total_alumni'] ?? 1) > 0 ? round(($stats['belum_diketahui'] ?? 0) / ($stats['total_alumni'] ?? 1) * 100, 1) : 0 }}%" aria-valuenow="{{ $stats['belum_diketahui'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ $stats['total_alumni'] ?? 1 }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        {{-- Chart --}}
        <div class="col-xl-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-pie-chart-fill me-2"></i>Distribusi Status Karir
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="statusChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-xl-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-transparent border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary w-100 mb-3">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Alumni
                    </a>
                    <a href="{{ route('admin.alumni.export') }}" class="btn btn-success w-100 mb-3">
                        <i class="bi bi-download me-2"></i>Export Data
                    </a>
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-primary w-100 mb-3">
                        <i class="bi bi-list-ul me-2"></i>Lihat Semua
                    </a>
                    <button class="btn btn-info w-100" onclick="validateAll()">
                        <i class="bi bi-check-circle me-2"></i>Validate Pddikti
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Alumni --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-transparent border-0 py-3">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-clock-history me-2"></i>Alumni Terbaru (5)
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 pro-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tahun Lulus</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAlumni ?? [] as $alumni)
                        <tr class="table-hover">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                        <i class="bi bi-person fs-6 text-primary"></i>
                                    </div>
                                    {{ Str::limit($alumni->nama, 25) }}
                                </div>
                            </td>
                            <td><code class="small">{{ $alumni->nim }}</code></td>
                            <td>{{ Str::limit($alumni->prodi ?? '-', 20) }}</td>
                            <td><span class="badge bg-light text-dark">{{ $alumni->tahun_lulus ?? '-' }}</span></td>
                            <td>
                                <span class="badge {{ $alumni->status_karir == 'Bekerja' ? 'bg-success' : ($alumni->status_karir == 'Wirausaha' ? 'bg-warning' : 'bg-secondary') }} fs-6 px-3 py-2">
                                    {{ $alumni->status_karir ?? ' - ' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.alumni.show', $alumni) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.alumni.edit', $alumni) }}" class="btn btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 mb-3 opacity-50"></i>
                                <p>Belum ada data alumni</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light border-0 py-3">
                <div class="text-end">
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-right me-2"></i>Lihat Semua Alumni
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pro-card-hover {
    transition: all 0.3s ease;
    transform: translateY(0);
}
.pro-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}
.pro-table tbody tr:hover {
    background-color: rgba(0,123,255,.05);
}
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.875rem;
}
.bg-gradient {
    background: linear-gradient(135deg, currentColor, color-mix(in srgb, currentColor 70%, transparent)) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 200;
        let current = 0;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 10);
    });

    // Pie Chart
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusData = [
        { label: 'Bekerja', value: {{ $stats['bekerja'] ?? 0 }}, color: '#28a745' },
        { label: 'Wirausaha', value: {{ $stats['wirausaha'] ?? 0 }}, color: '#ffc107' },
        { label: 'Studi Lanjut', value: {{ $stats['studi_lanjut'] ?? 0 }}, color: '#17a2b8' },
        { label: 'Belum Diketahui', value: {{ $stats['belum_diketahui'] ?? 0 }}, color: '#6c757d' }
    ].filter(item => item.value > 0);

    if (statusData.length > 0) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: statusData.map(item => item.label),
                datasets: [{
                    data: statusData.map(item => item.value),
                    backgroundColor: statusData.map(item => item.color),
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 20, usePointStyle: true }
                    }
                }
            }
        });
    } else {
        ctx.canvas.parentNode.innerHTML = '<div class="text-center py-5 text-muted"><i class="bi bi-graph-up-arrow fs-1 mb-3 opacity-50"></i><p>Tidak ada data untuk ditampilkan</p></div>';
    }
});

function validateAll() {
    if (confirm('Validate semua alumni via Pddikti?')) {
        // TODO: Implement batch validation
        alert('Fitur batch validation akan segera hadir!');
    }
}
</script>
@endsection

