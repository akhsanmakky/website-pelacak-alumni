<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pelacakan Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-people-fill me-2"></i>Pelacakan Alumni
            </a>
            <div class="navbar-nav ms-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">
                    <i class="bi bi-speedometer2 text-primary me-2"></i>Dashboard
                </h2>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Alumni</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $stats['total_alumni'] ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fas fa-calendar fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bekerja</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $stats['bekerja'] ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-briefcase fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Wirausaha</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $stats['wirausaha'] ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-lightbulb fas fa-comments fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Belum Diketahui</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $stats['belum_diketahui'] ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-question-circle fas fa-paper-plane fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Alumni Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Prodi</th>
                                        <th>Tahun Lulus</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentAlumni ?? [] as $alumni)
                                    <tr>
                                        <td>{{ $alumni->nama }}</td>
                                        <td>{{ $alumni->nim }}</td>
                                        <td>{{ $alumni->prodi }}</td>
                                        <td>{{ $alumni->tahun_lulus }}</td>
                                        <td>
                                            <span class="badge bg-{{ $alumni->status_karir == 'Bekerja' ? 'success' : ($alumni->status_karir == 'Wirausaha' ? 'warning' : 'info') }}">
                                                {{ $alumni->status_karir }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data alumni</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <a href="{{ route('admin.alumni.index') }}" class="btn btn-primary">
                                <i class="bi bi-list-ul me-1"></i>Kelola Alumni
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

