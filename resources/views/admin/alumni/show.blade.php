@extends('layouts.app')

@section('title', 'Detail Alumni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Detail Alumni: {{ $alumni->nama }}</h1>
            <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Alumni</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $alumni->nama }}</p>
                            <p><strong>NIM:</strong> {{ $alumni->nim }}</p>
                            <p><strong>Prodi:</strong> {{ $alumni->prodi }}</p>
                            <p><strong>Tahun Lulus:</strong> {{ $alumni->tahun_lulus }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $alumni->email }}</p>
                            <p><strong>No HP:</strong> {{ $alumni->no_hp }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $alumni->pekerjaan ?? '-' }}</p>
                            <p><strong>Perusahaan:</strong> {{ $alumni->perusahaan ?? '-' }}</p>
                            <p><strong>Status Karir:</strong> 
                                <span class="badge bg-{{ $alumni->status_karir == 'Bekerja' ? 'success' : ($alumni->status_karir == 'Wirausaha' ? 'warning' : ($alumni->status_karir == 'Studi Lanjut' ? 'info' : 'secondary')) }}">
                                    {{ $alumni->status_karir }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Riwayat Pelacakan</h5>
                </div>
                <div class="card-body">
                    @if($alumni->trackings->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status Lama</th>
                                    <th>Status Baru</th>
                                    <th>Dipubah Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumni->trackings as $tracking)
                                    <tr>
                                        <td>{{ $tracking->created_at->format('d/m/Y H:i') }}</td>
                                        <td><span class="badge bg-secondary">{{ $tracking->status_karir_old }}</span></td>
                                        <td><span class="badge bg-primary">{{ $tracking->status_karir_new }}</span></td>
                                        <td>{{ $tracking->updated_by }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Belum ada riwayat pelacakan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
