<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'name_variations',
        'keywords',
        'status',
        'confidence',
        'last_tracked_at',
    ];

    protected $casts = [
        'name_variations' => 'array',
        'keywords' => 'array',
        'confidence' => 'float',
        'last_tracked_at' => 'datetime',
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }

    public function searchJobs(): HasMany
    {
        return $this->hasMany(SearchJob::class);
    }

    public function isReadyForTracking(): bool
    {
        return $this->status === 'pending' || 
               ($this->status !== 'identified' && $this->last_tracked_at?->diffInMonths(now()) > 6);
    }
}

