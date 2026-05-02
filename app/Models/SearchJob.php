<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SearchJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_profile_id',
        'query',
        'source',
        'status',
        'results',
    ];

    protected $casts = [
        'results' => 'array',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(AlumniProfile::class, 'alumni_profile_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(SearchResult::class);
    }

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}

