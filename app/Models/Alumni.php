<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlumniTracking;
use App\Models\AlumniProfile;

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
        'alamat_bekerja',
        'status_karir',
        'pddikti_status',
        'auto_tracking_status',
        'auto_confidence',
        'last_auto_tracked_at',
        'linkedin',
        'instagram',
        'facebook',
        'tiktok',
        'company_social',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
        'pddikti_status' => 'string',
        'auto_confidence' => 'float',
        'last_auto_tracked_at' => 'datetime',
    ];

    protected $table = 'alumni';

    /**
     * Scope: Alumni dengan status Bekerja (termasuk PNS, Swasta, dll di bawah kategori bekerja)
     */
    public function scopeBekerja($query)
    {
        return $query->where('status_karir', 'Bekerja');
    }

    /**
     * Scope: Alumni dengan status Wirausaha
     */
    public function scopeWirausaha($query)
    {
        return $query->where('status_karir', 'Wirausaha');
    }

    /**
     * Scope: Alumni dengan status Studi Lanjut
     */
    public function scopeStudiLanjut($query)
    {
        return $query->where('status_karir', 'Studi Lanjut');
    }

    /**
     * Scope: Alumni dengan status Belum Diketahui (belum punya pekerjaan)
     */
    public function scopeBelumDiketahui($query)
    {
        return $query->where('status_karir', 'Belum Diketahui');
    }

    /**
     * Scope: Alumni yang tidak memiliki pekerjaan (untuk tracking follow-up)
     */
    public function scopeUnemployed($query)
    {
        return $query->where(function ($q) {
            $q->where('status_karir', 'Belum Diketahui')
              ->orWhereNull('pekerjaan');
        });
    }

    /**
     * Scope: Alumni yang sudah bekerja (Bekerja atau Wirausaha)
     */
    public function scopeEmployed($query)
    {
        return $query->whereIn('status_karir', ['Bekerja', 'Wirausaha']);
    }

    /**
     * Legacy scopes untuk backward compatibility dengan kode lama.
     * @deprecated Gunakan scopeBekerja() sebagai pengganti.
     */
    public function scopePns($query)
    {
        return $query->where('status_karir', 'Bekerja');
    }

    /**
     * @deprecated Gunakan scopeBekerja() sebagai pengganti.
     */
    public function scopeSwasta($query)
    {
        return $query->where('status_karir', 'Bekerja');
    }

    public function trackings()
    {
        return $this->hasMany(AlumniTracking::class);
    }

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AlumniProfile::class);
    }

    /**
     * Scope: Alumni ready for auto-tracking (pending or outdated)
     */
    public function scopeAutoReady($query)
    {
        return $query->where(function ($q) {
            $q->whereDoesntHave('profile')
              ->orWhereHas('profile', function ($p) {
                  $p->where('status', 'pending')
                    ->orWhere(function ($pp) {
                        $pp->where('status', '!=', 'identified')
                           ->where('last_tracked_at', '<', now()->subMonths(6));
                    });
              });
        });
    }

    /**
     * Scope: Alumni with auto-tracking identified (high confidence)
     */
    public function scopeAutoIdentified($query)
    {
        return $query->whereHas('profile', function ($p) {
            $p->where('status', 'identified')->where('confidence', '>=', 0.7);
        });
    }

    /**
     * Scope: Alumni needing manual verification from auto
     */
    public function scopeAutoNeedsManual($query)
    {
        return $query->whereHas('profile', function ($p) {
            $p->where('status', 'needs_manual');
        });
    }

    /**
     * Check if alumni is currently unemployed.
     */
    public function isUnemployed(): bool
    {
        return $this->status_karir === 'Belum Diketahui' || is_null($this->pekerjaan);
    }

    /**
     * Check if alumni is currently employed (working or entrepreneur).
     */
    public function isEmployed(): bool
    {
        return in_array($this->status_karir, ['Bekerja', 'Wirausaha'], true);
    }
}
