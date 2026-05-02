<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_job_id',
        'title',
        'url',
        'snippet',
        'publish_date',
        'signals',
        'score',
        'is_match',
    ];

    protected $casts = [
        'signals' => 'array',
        'publish_date' => 'date',
        'score' => 'float',
        'is_match' => 'boolean',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(SearchJob::class);
    }
}

