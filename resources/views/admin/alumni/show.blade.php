@extends('layouts.admin')

@section('title', 'Detail Alumni - ' . $alumni->nama)

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8" data-aos="fade-up">
    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.alumni.index') }}" class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left text-gray-600 dark:text-gray-400"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Profil Alumni</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.alumni.edit', ['alumnus' => $alumni->id]) }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold transition-all shadow-lg shadow-amber-500/20">
                    <i class="fas fa-edit mr-2"></i>Edit Alumni
                </a>
                <form action="{{ route('admin.alumni.destroy', ['alumnus' => $alumni->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold transition-all shadow-lg shadow-red-500/20">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                    <div class="relative inline-block mb-6">
                        <div class="w-32 h-32 bg-gradient-to-tr from-primary-600 to-indigo-500 rounded-full flex items-center justify-center text-white text-5xl shadow-inner">
                            @if($alumni->foto)
                                <img src="{{ asset('storage/'.$alumni->foto) }}" class="w-full h-full object-cover rounded-full border-4 border-white dark:border-gray-700">
                            @else
                                <i class="fas fa-user-graduate"></i>
                            @endif
                        </div>
                        <div class="absolute bottom-1 right-1 w-8 h-8 bg-green-500 border-4 border-white dark:border-gray-800 rounded-full"></div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $alumni->nama }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 font-medium mb-4">{{ $alumni->nim }}</p>

                    <div class="flex flex-col gap-2">
                        <span class="px-4 py-2 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-lg text-sm font-bold">
                            {{ $alumni->prodi ?? 'Prodi Belum Diisi' }}
                        </span>
                        <span class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-bold">
                            Angkatan {{ $alumni->tahun_lulus ?? '-' }}
                        </span>
                    </div>

                <!-- Contact Info -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 text-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="truncate">
                                <p class="text-xs text-gray-500 uppercase font-bold">Email</p>
                                <a href="mailto:{{ $alumni->email }}" class="text-sm dark:text-gray-300 truncate hover:text-primary-600">{{ $alumni->email }}</a>
                            </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-green-50 dark:bg-green-900/30 text-green-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">WhatsApp / HP</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $alumni->no_hp) }}" target="_blank" class="text-sm dark:text-gray-300 hover:text-green-600">{{ $alumni->no_hp ?? '-' }}</a>
                            </div>
                    </div>

                <!-- Social Media -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Media Sosial</h3>
                    <div class="space-y-3">
                        @if($alumni->linkedin)
                        <a href="{{ $alumni->linkedin }}" target="_blank" class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            <i class="fab fa-linkedin text-blue-600 text-xl"></i>
                            <span class="text-sm font-bold text-blue-700 dark:text-blue-300">LinkedIn</span>
                        </a>
                        @endif
                        @if($alumni->instagram)
                        <a href="{{ $alumni->instagram }}" target="_blank" class="flex items-center gap-3 p-3 bg-pink-50 dark:bg-pink-900/20 rounded-xl hover:bg-pink-100 dark:hover:bg-pink-900/40 transition-colors">
                            <i class="fab fa-instagram text-pink-600 text-xl"></i>
                            <span class="text-sm font-bold text-pink-700 dark:text-pink-300">Instagram</span>
                        </a>
                        @endif
                        @if($alumni->facebook)
                        <a href="{{ $alumni->facebook }}" target="_blank" class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            <i class="fab fa-facebook text-blue-700 text-xl"></i>
                            <span class="text-sm font-bold text-blue-700 dark:text-blue-300">Facebook</span>
                        </a>
                        @endif
                        @if($alumni->tiktok)
                        <a href="{{ $alumni->tiktok }}" target="_blank" class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            <i class="fab fa-tiktok text-black dark:text-white text-xl"></i>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300">TikTok</span>
                        </a>
                        @endif
                        @if(!$alumni->linkedin && !$alumni->instagram && !$alumni->facebook && !$alumni->tiktok)
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data media sosial</p>
                        @endif
                    </div>
            </div>

            <div class="lg:col-span-2 space-y-8">

                <!-- Career Status -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-gray-700 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4">
                        <i class="fas fa-briefcase text-6xl text-gray-100 dark:text-gray-700/50"></i>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Status Karir Saat Ini</h3>

                    @php
                        $status = $alumni->status_karir ?? 'Belum Diketahui';
                        $config = match($status) {
                            'Bekerja' => ['bg-blue-100 text-blue-700 border-blue-200', '🏢 Bekerja'],
                            'Wirausaha' => ['bg-amber-100 text-amber-700 border-amber-200', '💡 Wirausaha / Owner'],
                            'Studi Lanjut' => ['bg-cyan-100 text-cyan-700 border-cyan-200', '🎓 Studi Lanjut'],
                            default => ['bg-gray-100 text-gray-600 border-gray-200', '❓ Belum Ada Data'],
                        };
                    @endphp

                    <div class="inline-flex items-center px-6 py-3 rounded-2xl border-2 {{ $config[0] }} mb-8">
                        <span class="text-lg font-bold">{{ $config[1] }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Perusahaan / Instansi</p>
                            <p class="text-lg font-bold dark:text-white">{{ $alumni->perusahaan ?? 'Tidak Tersedia' }}</p>
                        </div>
                        <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Jabatan / Posisi</p>
                            <p class="text-lg font-bold dark:text-white">{{ $alumni->pekerjaan ?? 'Tidak Tersedia' }}</p>
                        </div>
                        <div class="md:col-span-2 p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Alamat Tempat Bekerja</p>
                            <p class="text-lg font-bold dark:text-white">{{ $alumni->alamat_bekerja ?? 'Tidak Tersedia' }}</p>
                        </div>
                        @if($alumni->company_social)
                        <div class="md:col-span-2">
                            <a href="{{ $alumni->company_social }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 rounded-xl font-bold hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition-colors">
                                <i class="fas fa-globe"></i> Sosial Media Perusahaan
                            </a>
                        </div>
                        @endif
                    </div>

                <!-- PDDIKTI Verification -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Verifikasi PDDIKTI</h3>
                            <p class="text-sm text-gray-500">Status sinkronisasi data dengan pangkalan data nasional.</p>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $pddikti = $alumni->pddikti_status ?? 'pending';
                                $pddiktiClass = match($pddikti) {
                                    'verified' => 'bg-green-500',
                                    'not_found' => 'bg-red-500',
                                    default => 'bg-amber-500',
                                };
                            @endphp
                            <span class="px-4 py-2 {{ $pddiktiClass }} text-white rounded-xl font-bold text-sm shadow-sm">
                                {{ strtoupper($pddikti) }}
                            </span>
                            <form action="{{ route('admin.alumni.validate', ['alumnus' => $alumni->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 text-primary-600 hover:bg-primary-50 rounded-lg transition-colors">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>
                        </div>
                </div>

                <!-- Tracking History -->
                @if($alumni->trackings && $alumni->trackings->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Riwayat Pembaruan</h3>
                    <div class="relative space-y-6 before:absolute before:inset-0 before:ml-5 before:-translate-x-px before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-200 before:to-transparent">
                        @foreach($alumni->trackings->sortByDesc('created_at') as $track)
                        <div class="relative">
                            <div class="flex items-start gap-4">
                                <div class="absolute left-0 w-10 h-10 flex items-center justify-center bg-white dark:bg-gray-800 border-2 border-primary-500 rounded-full shadow-sm z-10">
                                    <i class="fas fa-history text-xs text-primary-600"></i>
                                </div>
                                <div class="pl-14 w-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-sm font-bold dark:text-white">Perubahan oleh {{ $track->updated_by }}</p>
                                        <span class="text-xs text-gray-500">{{ $track->created_at->translatedFormat('d F Y, H:i') }}</span>
                                    </div>

                                    <div class="space-y-1.5">
                                        @if($track->status_karir_old !== $track->status_karir_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Status:</span>
                                            <span class="line-through text-red-500">{{ $track->status_karir_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->status_karir_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->perusahaan_old !== $track->perusahaan_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Perusahaan:</span>
                                            <span class="line-through text-red-500">{{ $track->perusahaan_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->perusahaan_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->pekerjaan_old !== $track->pekerjaan_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Posisi:</span>
                                            <span class="line-through text-red-500">{{ $track->pekerjaan_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->pekerjaan_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->alamat_bekerja_old !== $track->alamat_bekerja_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Alamat:</span>
                                            <span class="line-through text-red-500">{{ $track->alamat_bekerja_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->alamat_bekerja_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->company_social_old !== $track->company_social_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Sosial Media Perusahaan:</span>
                                            <span class="line-through text-red-500">{{ $track->company_social_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->company_social_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->linkedin_old !== $track->linkedin_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">LinkedIn:</span>
                                            <span class="line-through text-red-500">{{ $track->linkedin_old ? 'Tersedia' : '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->linkedin_new ? 'Tersedia' : '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->instagram_old !== $track->instagram_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Instagram:</span>
                                            <span class="line-through text-red-500">{{ $track->instagram_old ? 'Tersedia' : '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->instagram_new ? 'Tersedia' : '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->facebook_old !== $track->facebook_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Facebook:</span>
                                            <span class="line-through text-red-500">{{ $track->facebook_old ? 'Tersedia' : '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->facebook_new ? 'Tersedia' : '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->tiktok_old !== $track->tiktok_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">TikTok:</span>
                                            <span class="line-through text-red-500">{{ $track->tiktok_old ? 'Tersedia' : '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->tiktok_new ? 'Tersedia' : '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->email_old !== $track->email_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">Email:</span>
                                            <span class="line-through text-red-500">{{ $track->email_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->email_new ?? '-' }}</span>
                                        </div>
                                        @endif

                                        @if($track->no_hp_old !== $track->no_hp_new)
                                        <div class="text-sm">
                                            <span class="text-gray-500">No HP:</span>
                                            <span class="line-through text-red-500">{{ $track->no_hp_old ?? '-' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400 mx-1"></i>
                                            <span class="text-green-600 font-bold">{{ $track->no_hp_new ?? '-' }}</span>
                                        </div>
                                        @endif
                                    </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
    </div>
@endsection
