<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [\n        'nama',\n        'nim',\n        'prodi',\n        'tahun_lulus',\n        'email',\n        'no_hp',\n        'pekerjaan',\n        'perusahaan',\n        'status_karir',\n        'pddikti_status',\n    ];\n\n    protected $casts = [\n        'tahun_lulus' => 'integer',\n        'pddikti_status' => 'string',\n    ];

    protected $table = 'alumni';

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];

    public function trackings()
    {
        return $this->hasMany(AlumniTracking::class);
    }
}

