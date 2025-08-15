<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Version extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function releaseChannel(): BelongsTo
    {
        return $this->belongsTo(ReleaseChannel::class);
    }

    protected $casts = [
        'is_published' => 'boolean',
        'notes' => 'array',
        'forced_update' => 'boolean',
        'released_at' => 'datetime',
    ];

    public function fileArtifacts(): HasMany
    {
        return $this->hasMany(FileArtifact::class);
    }
}
