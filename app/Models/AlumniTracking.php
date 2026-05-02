<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'status_karir_old',
        'status_karir_new',
        'perusahaan_old',
        'perusahaan_new',
        'pekerjaan_old',
        'pekerjaan_new',
        'alamat_bekerja_old',
        'alamat_bekerja_new',
        'company_social_old',
        'company_social_new',
        'linkedin_old',
        'linkedin_new',
        'instagram_old',
        'instagram_new',
        'facebook_old',
        'facebook_new',
        'tiktok_old',
        'tiktok_new',
        'email_old',
        'email_new',
        'no_hp_old',
        'no_hp_new',
        'updated_by',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}

