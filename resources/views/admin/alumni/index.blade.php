@extends('layouts.app')

@section('title', 'Data Alumni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Data Alumni</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>

<div class="row mb-4">
        <!-- Stats Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PNS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pns'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Swasta</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['swasta'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Wirausaha</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['wirausaha'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Alumni</h6>
                </div>
                <div class="card-body">
                    <canvas id="alumniChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-12">
            <form method="GET" action="{{ route('admin.alumni.index') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search_nama" class="form-control" placeholder="Nama" value="{{ $searchNama ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="email" name="search_email" class="form-control" placeholder="Email" value="{{ $searchEmail ?? '' }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="search_tempat_kerja" class="form-control" placeholder="Tempat Kerja" value="{{ $searchTempatKerja ?? '' }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="search_posisi" class="form-control" placeholder="Posisi" value="{{ $searchPosisi ?? '' }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
                <div class="col-md-12 text-end">
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary me-2">Reset</a>
                    <a href="{{ route('admin.alumni.export') }}" class="btn btn-success">Export Excel</a>
                    <a href="{{ route('admin.alumni.create') }}" class="btn btn-info">Tambah Alumni</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tahun Lulus</th>
                            <th>Email</th>
                            <th>Status Karir</th>
                            <th>PDDIKTI</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumni as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td>{{ $item->tahun_lulus }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
@php
                                        $isPns = str_contains(strtolower($item->pekerjaan ?? ''), 'pns');
                                        if ($isPns) {
                                            $statusClass = 'primary';
                                        } elseif ($item->status_karir == 'Wirausaha') {
                                            $statusClass = 'warning';
                                        } elseif ($item->status_karir == 'Bekerja') {
                                            $statusClass = 'success';
                                        } else {
                                            $statusClass = 'info';
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ $item->status_karir }}
                                    </span>

                                </td>
                                <td>
<span class="badge bg-{{ $item->pddikti_status == 'verified' ? 'success' : ( $item->pddikti_status == 'pending' ? 'warning' : ( $item->pddikti_status == 'not_found' ? 'danger' : 'secondary' ) ) }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->pddikti_status ?? 'pending')) }}
                                    </span>
                                    <form action="{{ route('admin.alumni.validate', $item) }}" method="POST" class="d-inline mt-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Validasi PDDIKTI</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.alumni.show', $item) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('admin.alumni.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.alumni.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data alumni.</td>

                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $alumni->links() }}
        </div>
    </div>
</div>
        <script>
            const ctx = document.getElementById('alumniChart').getContext('2d');
            const alumniChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['PNS', 'Swasta', 'Wirausaha'],
                    datasets: [{
                        data: [{{ $stats['pns'] ?? 0 }}, {{ $stats['swasta'] ?? 0 }}, {{ $stats['wirausaha'] ?? 0 }}],
                        backgroundColor: [
                            'rgb(0, 123, 255)',
                            'rgb(40, 167, 69)',
                            'rgb(255, 193, 7)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        </script>
@endsection

