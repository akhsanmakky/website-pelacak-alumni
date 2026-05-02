@extends('layouts.admin')

@section('title', 'Edit Alumni - {{ $alumni->nama }}')

@section('content')
<div data-aos="fade-up">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-24 h-24 bg-gradient-to-br from-amber-500 to-orange-500 rounded-3xl flex items-center justify-center text-white shadow-2xl p-6">
                    <i class="fas fa-edit text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-200 bg-clip-text text-transparent mb-3">
                        Edit Data Alumni
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Update informasi {{ $alumni->nama }} ({{ $alumni->nim }})</p>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.alumni.show', $alumni) }}" class="px-8 py-3 bg-gray-200 dark:bg-gray-800 border rounded-2xl font-bold hover:shadow-lg hover:-translate-y-1 transition-all flex items-center">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </a>
                <a href="{{ route('admin.alumni.index') }}" class="px-8 py-3 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-200 border rounded-2xl font-bold hover:shadow-lg hover:-translate-y-1 transition-all flex items-center">
                    <i class="fas fa-list mr-2"></i>Kembali ke List
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-3xl p-12 shadow-3xl" data-aos="zoom-in" data-aos-delay="200">
            <form action="{{ route('admin.alumni.update', $alumni) }}" method="POST" class="space-y-8">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Info -->
                    <div data-aos="fade-right">
                        <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent border-b border-white/20 pb-6">
                            <i class="fas fa-user mr-3"></i>Informasi Pribadi
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Nama Lengkap Alumni *</label>
                                <input type="text" 
                                       name="nama" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('nama') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('nama', $alumni->nama) }}" 
                                       required>
                                @error('nama')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">NIM *</label>
                                <input type="text" 
                                       name="nim" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl font-mono uppercase focus:ring-4 ring-primary-500/30 @error('nim') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('nim', $alumni->nim) }}" 
                                       required>
                                @error('nim')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Program Studi *</label>
                                <input type="text" 
                                       name="prodi" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('prodi') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('prodi', $alumni->prodi) }}" 
                                       required>
                                @error('prodi')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Tahun Lulus *</label>
                                <input type="number" 
                                       name="tahun_lulus" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('tahun_lulus') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" 
                                       min="1900" 
                                       max="2100"
                                       required>
                                @error('tahun_lulus')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Career -->
                    <div data-aos="fade-left">
                        <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent border-b border-white/20 pb-6">
                            <i class="fas fa-briefcase mr-3"></i>Kontak & Karir
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Email *</label>
                                <input type="email" 
                                       name="email" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('email') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('email', $alumni->email) }}" 
                                       required>
                                @error('email')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">No. Handphone *</label>
                                <input type="tel" 
                                       name="no_hp" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('no_hp') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('no_hp', $alumni->no_hp) }}" 
                                       required>
                                @error('no_hp')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Status Karir *</label>
                                <select name="status_karir" class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('status_karir') ring-2 ring-red-500 @enderror" required>
                                    <option value="">Pilih Status Karir</option>
                                    <option value="Bekerja" {{ old('status_karir', $alumni->status_karir) == 'Bekerja' ? 'selected' : '' }}>🧑‍💼 Bekerja</option>
                                    <option value="Wirausaha" {{ old('status_karir', $alumni->status_karir) == 'Wirausaha' ? 'selected' : '' }}>💡 Wirausaha</option>
                                    <option value="Studi Lanjut" {{ old('status_karir', $alumni->status_karir) == 'Studi Lanjut' ? 'selected' : '' }}>🎓 Studi Lanjut</option>
                                    <option value="Belum Diketahui" {{ old('status_karir', $alumni->status_karir) == 'Belum Diketahui' ? 'selected' : '' }}>❓ Belum Diketahui</option>
                                </select>
                                @error('status_karir')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Jabatan</label>
                                <input type="text" 
                                       name="pekerjaan" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                       value="{{ old('pekerjaan', $alumni->pekerjaan) }}" 
                                       placeholder="Manager IT / Software Engineer">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Tempat Kerja</label>
                                <input type="text" 
                                       name="perusahaan" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                       value="{{ old('perusahaan', $alumni->perusahaan) }}" 
                                       placeholder="PT Telkom / Google Indonesia">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 pt-12 border-t border-white/20 mt-12">
                    <button type="submit" class="flex-1 px-12 py-6 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-3xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all">
                        <i class="fas fa-check mr-3"></i>Update Data Alumni
                    </button>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.alumni.show', $alumni) }}" class="flex-1 px-8 py-6 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border rounded-3xl font-bold text-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center">
                            <i class="fas fa-eye mr-3"></i>Lihat Detail
                        </a>
                        <a href="{{ route('admin.alumni.index') }}" class="px-8 py-6 bg-gray-200 dark:bg-gray-800 border rounded-3xl font-bold text-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center">
                            <i class="fas fa-list mr-3"></i>Kembali ke List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
