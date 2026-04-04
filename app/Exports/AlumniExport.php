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
            'email',
            'no_hp',
            'perusahaan as tempat_kerja',
            'pekerjaan as posisi',
            'status_karir',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'No HP',
            'Tempat Kerja',
            'Posisi',
            'Status Karir',
        ];
    }

    public function title(): string
    {
        return 'Data Alumni';
    }
}

