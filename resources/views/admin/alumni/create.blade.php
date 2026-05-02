@extends('layouts.admin')

@section('title', 'Tambah Alumni')

@section('content')
<div data-aos="fade-up">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-8">
                <div class="p-4 bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-2xl shadow-xl">
                    <i class="fas fa-user-plus text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-200 bg-clip-text text-transparent">
                        Tambah Data Alumni
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mt-2">Isi informasi lengkap alumni baru untuk database Anda</p>
                </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.alumni.index') }}" class="px-8 py-3 bg-gray-200 dark:bg-gray-800 border rounded-2xl font-bold hover:shadow-lg hover:-translate-y-1 transition-all flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

        <!-- Form Card -->
        <div class="glass-card rounded-3xl p-12 shadow-2xl" data-aos="zoom-in" data-aos-delay="200">
            <form action="{{ route('admin.alumni.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Info -->
                    <div data-aos="fade-right">
                        <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent border-b border-white/20 pb-4">
                            <i class="fas fa-user mr-3"></i>Informasi Pribadi
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Nama Lengkap Alumni *</label>
                                <input type="text" 
                                       name="nama" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('nama') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('nama') }}" 
                                       placeholder="Nama lengkap alumni"
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
                                       value="{{ old('nim') }}" 
                                       placeholder="2021001xxx"
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
                                       value="{{ old('prodi') }}" 
                                       placeholder="Teknik Informatika / Manajemen / dll"
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
                                       value="{{ old('tahun_lulus') }}" 
                                       min="1900" 
                                       max="2100"
                                       placeholder="2023"
                                       required>
                                @error('tahun_lulus')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                    </div>

                    <!-- Contact -->
                    <div data-aos="fade-left">
                        <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent border-b border-white/20 pb-4">
                            <i class="fas fa-address-book mr-3"></i>Kontak
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Email *</label>
                                <input type="email" 
                                       name="email" 
                                       class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30 @error('email') ring-2 ring-red-500 @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="alumni@univ.ac.id"
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
                                       value="{{ old('no_hp') }}" 
                                       placeholder="081234567890"
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
                                    <option value="Bekerja" {{ old('status_karir') == 'Bekerja' ? 'selected' : '' }}>🏢 Bekerja</option>
                                    <option value="Wirausaha" {{ old('status_karir') == 'Wirausaha' ? 'selected' : '' }}>💡 Wirausaha</option>
                                    <option value="Studi Lanjut" {{ old('status_karir') == 'Studi Lanjut' ? 'selected' : '' }}>🎓 Studi Lanjut</option>
                                    <option value="Belum Diketahui" {{ old('status_karir') == 'Belum Diketahui' ? 'selected' : '' }}>❓ Belum Diketahui</option>
                                </select>
                                @error('status_karir')
                                    <p class="mt-3 text-red-600 dark:text-red-400 flex items-center font-bold">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                    </div>

                <!-- Career Details -->
                <div class="border-t border-white/20 pt-8 mt-8">
                    <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                        <i class="fas fa-briefcase mr-3"></i>Detail Pekerjaan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Jabatan / Posisi</label>
                            <input type="text" 
                                   name="pekerjaan" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('pekerjaan') }}" 
                                   placeholder="Manager IT / Software Engineer / dll">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Tempat Kerja / Perusahaan</label>
                            <input type="text" 
                                   name="perusahaan" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('perusahaan') }}" 
                                   placeholder="PT Telkom Indonesia / Google Indonesia / Startup Anda">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Alamat Tempat Bekerja</label>
                            <textarea name="alamat_bekerja" 
                                      class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                      rows="3"
                                      placeholder="Jl. Sudirman No. 1, Jakarta Pusat">{{ old('alamat_bekerja') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Sosial Media Perusahaan</label>
                            <input type="url" 
                                   name="company_social" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('company_social') }}" 
                                   placeholder="https://linkedin.com/company/...">
                        </div>
                </div>

                <!-- Social Media -->
                <div class="border-t border-white/20 pt-8 mt-8">
                    <h3 class="text-2xl font-bold mb-8 bg-gradient-to-r from-primary-600 to-indigo-600 bg-clip-text text-transparent">
                        <i class="fas fa-share-alt mr-3"></i>Media Sosial Alumni
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                                <i class="fab fa-linkedin text-blue-600 mr-2"></i>LinkedIn
                            </label>
                            <input type="url" 
                                   name="linkedin" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('linkedin') }}" 
                                   placeholder="https://linkedin.com/in/username">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                                <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram
                            </label>
                            <input type="url" 
                                   name="instagram" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('instagram') }}" 
                                   placeholder="https://instagram.com/username">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                                <i class="fab fa-facebook text-blue-700 mr-2"></i>Facebook
                            </label>
                            <input type="url" 
                                   name="facebook" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('facebook') }}" 
                                   placeholder="https://facebook.com/username">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                                <i class="fab fa-tiktok text-black dark:text-white mr-2"></i>TikTok
                            </label>
                            <input type="url" 
                                   name="tiktok" 
                                   class="w-full input-glass px-6 py-5 rounded-2xl text-xl focus:ring-4 ring-primary-500/30" 
                                   value="{{ old('tiktok') }}" 
                                   placeholder="https://tiktok.com/@username">
                        </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-12 border-t border-white/20 mt-12">
                    <button type="submit" class="flex-1 px-12 py-6 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-3xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all">
                        <i class="fas fa-save mr-3"></i>Simpan Alumni Baru
                    </button>
                    <a href="{{ route('admin.alumni.index') }}" class="px-12 py-6 bg-gray-200 dark:bg-gray-800 border rounded-3xl font-bold text-xl hover:shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center">
                        <i class="fas fa-times mr-3"></i>Batal
                    </a>
                </div>
            </form>
        </div>
</div>
@endsection
