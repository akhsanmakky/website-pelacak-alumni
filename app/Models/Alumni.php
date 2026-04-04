<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlumniTracking;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'tahun_lulus',
        'email',
        'no_hp',
        'pekerjaan',
        'perusahaan',
        'status_karir',
        'pddikti_status',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
        'pddikti_status' => 'string',
    ];

    protected $table = 'alumni';

    public function scopePns($query)
    {
        return $query->whereRaw("LOWER(pekerjaan) LIKE '%pns%' OR LOWER(perusahaan) LIKE '%pns%'");
    }

    public function scopeSwasta($query)
    {
        return $query->where('status_karir', 'Bekerja')
                     ->whereNotIn('status_karir', ['Wirausaha', 'Studi Lanjut'])
                     ->whereRaw("LOWER(pekerjaan) NOT LIKE '%pns%'");
    }

    public function scopeWirausaha($query)
    {
        return $query->where('status_karir', 'Wirausaha');
    }

    public function trackings()
    {
        return $this->hasMany(AlumniTracking::class);
    }
}

