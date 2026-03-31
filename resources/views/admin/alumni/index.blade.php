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
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.alumni.index') }}">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIM..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.alumni.create') }}" class="btn btn-success">Tambah Alumni</a>
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
                                    <span class="badge bg-{{ $item->status_karir == 'Bekerja' ? 'success' : ($item->status_karir == 'Wirausaha' ? 'warning' : ($item->status_karir == 'Studi Lanjut' ? 'info' : 'secondary')) }}">
                                        {{ $item->status_karir }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $item->pddikti_status == 'verified' ? 'success' : ($item->pddikti_status == 'pending' ? 'warning' : ($item->pddikti_status == 'not_found' ? 'danger' : 'secondary')) }}">
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
                                <td colspan="7" class="text-center">Tidak ada data alumni.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $alumni->links() }}
        </div>
    </div>
</div>
@endsection
