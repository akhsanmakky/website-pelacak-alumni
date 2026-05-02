<?php

namespace App\Exports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AlumniExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Alumni::select([
            'nama',
            'nim',
            'email',
            'no_hp',
            'prodi',
            'tahun_lulus',
            'perusahaan as tempat_kerja',
            'alamat_bekerja',
            'pekerjaan as posisi',
            'status_karir',
            'linkedin',
            'instagram',
            'facebook',
            'tiktok',
            'company_social',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Email',
            'No HP',
            'Prodi',
            'Tahun Lulus',
            'Tempat Kerja',
            'Alamat Bekerja',
            'Posisi',
            'Status Karir',
            'LinkedIn',
            'Instagram',
            'Facebook',
            'TikTok',
            'Sosial Media Perusahaan',
        ];
    }

    public function title(): string
    {
        return 'Data Alumni';
    }
}

