@extends('layouts.admin')

@section('title', 'Data Alumni')

@section('content')
<div class="space-y-8 pb-8">

    {{-- 1. HEADER SECTION --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4" data-aos="fade-down">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-3">
                <span class="w-10 h-10 bg-gradient-to-br from-primary-600 to-indigo-600 rounded-xl flex items-center justify-center text-white text-lg shadow-lg">
                    <i class="fas fa-users"></i>
                </span>
                Data Alumni
            </h1>
            @if (session('success'))
            <div class="mt-3 inline-flex items-center px-4 py-2 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl text-green-800 dark:text-green-200 font-bold text-sm">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif
        </div>
        
<div class="flex flex-wrap gap-3 items-center">
            <a href="{{ route('admin.alumni.create') }}" class="px-5 py-2.5 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 transition-all hover:shadow-lg hover:shadow-primary-500/25 text-sm flex items-center gap-2">
                <i class="fas fa-plus"></i>Tambah
            </a>
            <a href="{{ route('admin.alumni.export') }}" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-all hover:shadow-lg hover:shadow-emerald-500/25 text-sm flex items-center gap-2">
                <i class="fas fa-download"></i>Export
            </a>
            <button onclick="openImportModal()" class="px-5 py-2.5 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition-all hover:shadow-lg hover:shadow-purple-500/25 text-sm flex items-center gap-2">
                <i class="fas fa-upload"></i>Import CSV
            </button>
            <form action="{{ route('admin.alumni.bulk-pddikti-verify') }}" method="POST" class="inline" onsubmit="return confirm('Verifikasi semua alumni ke PDDIKTI?')">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-cyan-600 text-white rounded-xl font-bold hover:bg-cyan-700 transition-all hover:shadow-lg hover:shadow-cyan-500/25 text-sm flex items-center gap-2">
                    <i class="fas fa-university"></i>Verify PDDIKTI
                </button>
            </form>
            <button id="bulkTrackBtn" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-all hover:shadow-lg hover:shadow-indigo-500/25 text-sm flex items-center gap-2 disabled:opacity-50" disabled>
                <i class="fas fa-robot"></i>Bulk Track (<span id="selectedCount">0</span>)
            </button>
        </div>
    </div>

    {{-- 2. STATS CARDS SECTION --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        @php
            $statCards = [
                ['key' => 'bekerja', 'label' => 'Bekerja', 'icon' => 'fa-briefcase', 'color' => 'blue', 'from' => 'from-blue-500', 'to' => 'to-blue-600'],
                ['key' => 'wirausaha', 'label' => 'Wirausaha', 'icon' => 'fa-lightbulb', 'color' => 'amber', 'from' => 'from-amber-500', 'to' => 'to-orange-600'],
                ['key' => 'belum_diketahui', 'label' => 'Belum Diketahui', 'icon' => 'fa-question-circle', 'color' => 'gray', 'from' => 'from-gray-500', 'to' => 'to-gray-600'],
                ['key' => 'total', 'label' => 'Total', 'icon' => 'fa-chart-line', 'color' => 'indigo', 'from' => 'from-indigo-500', 'to' => 'to-purple-600'],
            ];
            $totalAll = max($stats['total'] ?? 1, 1);
        @endphp
        
        @foreach($statCards as $i => $sc)
            @php 
                $val = $stats[$sc['key']] ?? 0; 
                $pct = $sc['key'] === 'total' ? 100 : round(($val / $totalAll) * 100, 1); 
            @endphp
            <div class="glass-card rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $sc['from'] }} {{ $sc['to'] }} flex items-center justify-center text-white shadow-lg">
                        <i class="fas {{ $sc['icon'] }} text-sm"></i>
                    </div>
                    <span class="text-2xl font-black text-{{ $sc['color'] }}-600 counter" data-target="{{ $val }}">0</span>
                </div>
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ $sc['label'] }}</h3>
                <div class="mt-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                    <div class="bg-gradient-to-r {{ $sc['from'] }} {{ $sc['to'] }} h-full rounded-full" style="width: {{ $pct }}%"></div>
                </div>
                <p class="text-[10px] text-gray-400 mt-1 font-medium">{{ $pct }}%</p>
            </div>
        @endforeach
    </div>

    {{-- 3. CHART & SEARCH FORM SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Chart Card --}}
        <div class="lg:col-span-2 glass-card rounded-2xl p-6 lg:p-8" data-aos="fade-right">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-chart-pie text-primary-600"></i>Statistik Alumni
                </h2>
            </div>
            <div class="relative h-64 lg:h-80">
                <canvas id="alumniChart"></canvas>
            </div>
        </div>
        
        {{-- Search Card --}}
        <div class="glass-card rounded-2xl p-6" data-aos="fade-left">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="fas fa-search text-primary-600"></i>Pencarian
            </h3>
            <form method="GET" action="{{ route('admin.alumni.index') }}" class="space-y-3">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nama</label>
                    <input type="text" name="search_nama" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Cari nama..." value="{{ $searchNama ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Email</label>
                    <input type="email" name="search_email" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Email" value="{{ $searchEmail ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">No. HP</label>
                    <input type="text" name="search_no_hp" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="08..." value="{{ $searchNoHp ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Tempat Kerja</label>
                    <input type="text" name="search_tempat_kerja" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Perusahaan" value="{{ $searchTempatKerja ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Posisi</label>
                    <input type="text" name="search_posisi" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Jabatan" value="{{ $searchPosisi ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Status</label>
                    <select name="search_status_karir" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm">
                        <option value="">Semua</option>
                        <option value="Bekerja" {{ ($searchStatusKarir ?? '') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                        <option value="Wirausaha" {{ ($searchStatusKarir ?? '') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                        <option value="Studi Lanjut" {{ ($searchStatusKarir ?? '') == 'Studi Lanjut' ? 'selected' : '' }}>Studi Lanjut</option>
                        <option value="Belum Diketahui" {{ ($searchStatusKarir ?? '') == 'Belum Diketahui' ? 'selected' : '' }}>Belum Diketahui</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Bekerja</label>
                    <input type="text" name="search_alamat_bekerja" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Kota" value="{{ $searchAlamatBekerja ?? '' }}">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Sosial Media</label>
                    <input type="text" name="search_social_media" class="w-full input-glass px-3 py-2.5 rounded-xl text-sm" placeholder="Username" value="{{ $searchSocialMedia ?? '' }}">
                </div>
                
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 transition-all text-sm">
                        <i class="fas fa-search mr-1"></i>Cari
                    </button>
                    <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2.5 bg-gray-100 dark:bg-gray-800 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm flex items-center justify-center">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- 4. CSV IMPORT MODAL --}}
    <div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4" onclick="closeImportModal()">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full max-h-[90vh] overflow-y-auto shadow-2xl" onclick="event.stopPropagation()">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <i class="fas fa-upload text-purple-600"></i> Import Alumni CSV
            </h3>
            <form action="{{ route('admin.alumni.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Pilih File CSV</label>
                    <input type="file" name="csv_file" accept=".csv" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary-600 file:text-white hover:file:bg-primary-700">
                    <p class="text-xs text-gray-500 mt-1">Format: nama,nim,prodi,tahun_lulus,email,no_hp</p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition-all shadow-lg">
                        <i class="fas fa-upload mr-1"></i>Import
                    </button>
                    <button type="button" onclick="closeImportModal()" class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-xl font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 5. TABLE SECTION --}}
    <div class="glass-card rounded-2xl overflow-hidden" data-aos="fade-up">
        <div class="p-5 lg:p-6 border-b border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Alumni</h2>
            <span class="text-xs text-gray-500 font-medium">
                {{ $alumni->firstItem() ?? 0 }}–{{ $alumni->lastItem() ?? 0 }} dari {{ $alumni->total() }} data
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 text-left">
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300">
                                Alumni
                            </label>
                        </th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Kontak</th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Pekerjaan</th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Karir Status</th>
<th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center hidden xl:table-cell">Auto Tracking</th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center hidden lg:table-cell">PDDIKTI</th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center hidden lg:table-cell">Sosmed</th>
                        <th class="px-4 lg:px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($alumni as $item)
                    <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/5 transition-colors group">
                        <td class="px-4 lg:px-6 py-3.5">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="alumni[]" value="{{ $item->id }}" class="alumni-checkbox w-4 h-4 rounded border-gray-300 focus:ring-primary-500">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary-500 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900 dark:text-white">{{ $item->nama }}</p>
                                        <p class="text-[10px] text-gray-500 font-mono">{{ $item->nim }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $item->prodi }} · {{ $item->tahun_lulus }}</p>
                                    </div>
                                </div>
                            </label>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 hidden md:table-cell">
                            <a href="mailto:{{ $item->email }}" class="block text-xs text-blue-600 hover:underline mb-0.5">{{ $item->email }}</a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}" target="_blank" class="block text-xs text-green-600 hover:underline">{{ $item->no_hp }}</a>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 hidden lg:table-cell">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->perusahaan ?? '-' }}</p>
                            <p class="text-xs text-gray-500 truncate max-w-[160px]" title="{{ $item->alamat_bekerja }}">{{ $item->alamat_bekerja ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ $item->pekerjaan ?? '-' }}</p>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 text-center">
                            @php
                                $sc = match($item->status_karir) {
                                    'Bekerja' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                    'Wirausaha' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                    'Studi Lanjut' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-300',
                                    default => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
                                };
                            @endphp
                            <span class="px-2.5 py-1 {{ $sc }} rounded-lg text-[10px] font-bold uppercase tracking-wider">{{ $item->status_karir ?? 'Belum' }}</span>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 text-center hidden xl:table-cell">
                            @if($item->profile && $item->profile->confidence)
                                <div class="space-y-1">
                                    <span class="text-xs font-bold text-emerald-600">{{ $item->profile->status }}</span>
                                    <div class="w-16 mx-auto bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-gradient-to-r from-emerald-400 to-green-500 h-1.5 rounded-full" style="width: {{ $item->profile->confidence * 100 }}%"></div>
                                    </div>
                                    <span class="text-[10px] text-gray-500">{{ number_format($item->profile->confidence * 100, 1) }}%</span>
                                </div>
@else
                                <span class="text-xs text-gray-400 italic">Belum dilacak</span>
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 text-center hidden lg:table-cell">
                            @php
                                $pddiktiStatus = $item->pddikti_status ?? null;
                                $pddiktiClass = match($pddiktiStatus) {
                                    'verified' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'not_found' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                    'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                                    'error' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400',
                                    default => 'bg-gray-50 text-gray-400 dark:bg-gray-900/50 dark:text-gray-500',
                                };
                            @endphp
                            <span class="px-2 py-1 {{ $pddiktiClass }} rounded text-[10px] font-bold uppercase">
                                {{ $pddiktiStatus ?: '--' }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 text-center hidden lg:table-cell">
                            <div class="flex gap-1 justify-center">
                                @if($item->linkedin)<a href="{{ $item->linkedin }}" target="_blank" class="w-6 h-6 bg-blue-50 text-blue-600 rounded flex items-center justify-center text-[10px] hover:bg-blue-100" title="LinkedIn"><i class="fab fa-linkedin"></i></a>@endif
                                @if($item->instagram)<a href="{{ $item->instagram }}" target="_blank" class="w-6 h-6 bg-pink-50 text-pink-600 rounded flex items-center justify-center text-[10px] hover:bg-pink-100" title="Instagram"><i class="fab fa-instagram"></i></a>@endif
                                @if($item->facebook)<a href="{{ $item->facebook }}" target="_blank" class="w-6 h-6 bg-blue-50 text-blue-700 rounded flex items-center justify-center text-[10px] hover:bg-blue-100" title="Facebook"><i class="fab fa-facebook"></i></a>@endif
                                @if($item->tiktok)<a href="{{ $item->tiktok }}" target="_blank" class="w-6 h-6 bg-gray-100 text-black dark:bg-gray-700 dark:text-white rounded flex items-center justify-center text-[10px] hover:bg-gray-200" title="TikTok"><i class="fab fa-tiktok"></i></a>@endif
                                @if($item->company_social)<a href="{{ $item->company_social }}" target="_blank" class="w-6 h-6 bg-indigo-50 text-indigo-600 rounded flex items-center justify-center text-[10px] hover:bg-indigo-100" title="Perusahaan"><i class="fas fa-globe"></i></a>@endif
                            </div>
                        </td>
                        <td class="px-4 lg:px-6 py-3.5 text-right">
                            <div class="flex gap-1 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.alumni.show', $item) }}" class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Detail"><i class="fas fa-eye text-xs"></i></a>
                                <a href="{{ route('admin.alumni.edit', ['alumnus' => $item->id]) }}" class="p-2 text-amber-600 hover:bg-amber-100 dark:hover:bg-amber-900/30 rounded-lg transition-colors" title="Edit"><i class="fas fa-edit text-xs"></i></a>
                                <form action="{{ route('admin.alumni.validate', $item) }}" method="POST" class="inline" onsubmit="return confirm('Validasi {{ $item->nama }} ke PDDIKTI?')">
                                    @csrf
                                    <button type="submit" class="p-2 text-primary-600 hover:bg-primary-100 dark:hover:bg-primary-900/30 rounded-lg transition-colors" title="Validasi PDDIKTI"><i class="fas fa-sync-alt text-xs"></i></button>
                                </form>
                                <form action="{{ route('admin.alumni.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus {{ $item->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Hapus"><i class="fas fa-trash text-xs"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-4xl mb-3 opacity-30">📂</div>
                            <p class="text-gray-500 font-medium">Belum ada data alumni</p>
                            <a href="{{ route('admin.alumni.create') }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-primary-600 text-white rounded-xl font-bold text-sm hover:bg-primary-700 transition-all">
                                <i class="fas fa-plus"></i>Tambah Alumni Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($alumni->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-gray-800">
            <div class="flex justify-center">
                {{ $alumni->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Bulk Select
    const selectAll = document.getElementById('selectAll');
    const bulkBtn = document.getElementById('bulkTrackBtn');
    const selectedCount = document.getElementById('selectedCount');

    selectAll.addEventListener('change', function () {
        document.querySelectorAll('.alumni-checkbox').forEach(cb => cb.checked = this.checked);
        updateBulkBtn();
    });

    document.querySelectorAll('.alumni-checkbox').forEach(cb => {
        cb.addEventListener('change', updateBulkBtn);
    });

    function updateBulkBtn() {
        const checked = document.querySelectorAll('.alumni-checkbox:checked').length;
        selectedCount.textContent = checked;
        bulkBtn.disabled = checked === 0;
    }

    // 🔥 BULK TRACK FIX TOTAL
    bulkBtn.addEventListener('click', function () {
        const selected = Array.from(document.querySelectorAll('.alumni-checkbox:checked'))
            .map(cb => Number(cb.value)); // ✅ pastikan array number

        if (selected.length === 0) {
            alert('Pilih minimal 1 alumni');
            return;
        }

        if (!confirm(`Track ${selected.length} alumni secara otomatis?`)) return;

        fetch('{{ route('admin.alumni.bulk-track') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                alumni_ids: selected
            })
        })
        .then(async res => {
            const text = await res.text();

            try {
                const data = JSON.parse(text);

                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }

            } catch (e) {
                console.error("Response bukan JSON:", text);
                alert("Server error (cek console)");
            }
        })
        .catch(err => {
            console.error(err);
            alert('Request gagal');
        });
    });

});
</script>

    // Modals
    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('importModal').classList.add('flex');
    }

    function closeImportModal() {
        document.getElementById('importModal').classList.add('hidden');
        document.getElementById('importModal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Counter animation
    document.querySelectorAll('.counter').forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const step = target / 60;
        let current = 0;
        const update = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current).toLocaleString('id-ID');
                requestAnimationFrame(update);
            } else {
                counter.textContent = target.toLocaleString('id-ID');
            }
        };
        update();
    });

    // Chart
    const ctx = document.getElementById('alumniChart')?.getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Bekerja', 'Wirausaha', 'Studi Lanjut', 'Belum Diketahui'],
                datasets: [{
                    data: [{{ $stats['bekerja'] ?? 0 }}, {{ $stats['wirausaha'] ?? 0 }}, {{ $stats['studi_lanjut'] ?? 0 }}, {{ $stats['belum_diketahui'] ?? 0 }}],
                    backgroundColor: ['#3b82f6', '#f59e0b', '#06b6d4', '#9ca3af'],
                    borderWidth: 3,
                    borderColor: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, font: { size: 12, weight: '600' } }
                    },
                    tooltip: {
                        callbacks: {
                            label: (c) => ` ${c.label}: ${c.parsed.toLocaleString('id-ID')}`
                        }
                    }
                },
                animation: { animateRotate: true, duration: 1500 }
            }
        });
    }
</script>
@endsection