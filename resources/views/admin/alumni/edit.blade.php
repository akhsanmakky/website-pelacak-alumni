@extends('layouts.app')

@section('title', 'Edit Alumni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Edit Data Alumni</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.alumni.update', $alumni) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Alumni</label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $alumni->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $alumni->nim) }}" required>
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Similar fields as create, with old() or $alumni->field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Program Studi</label>
                                    <input type="text" name="prodi" class="form-control @error('prodi') is-invalid @enderror" value="{{ old('prodi', $alumni->prodi) }}" required>
                                    @error('prodi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" min="1900" max="2100" required>
                                    @error('tahun_lulus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $alumni->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $alumni->no_hp) }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan', $alumni->pekerjaan) }}">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" value="{{ old('perusahaan', $alumni->perusahaan) }}">
                                    @error('perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status Karir</label>
                                    <select name="status_karir" class="form-select @error('status_karir') is-invalid @enderror" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Bekerja" {{ old('status_karir', $alumni->status_karir) == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                        <option value="Wirausaha" {{ old('status_karir', $alumni->status_karir) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                        <option value="Studi Lanjut" {{ old('status_karir', $alumni->status_karir) == 'Studi Lanjut' ? 'selected' : '' }}>Studi Lanjut</option>
                                        <option value="Belum Diketahui" {{ old('status_karir', $alumni->status_karir) == 'Belum Diketahui' ? 'selected' : '' }}>Belum Diketahui</option>
                                    </select>
                                    @error('status_karir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
