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
        'updated_by',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}

