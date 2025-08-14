<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Version extends Model
{
    protected $fillable = [
        'product_id',
        'number',
        'release_channel_id',
        'is_published',
        'notes',
        'forced_update',
        'released_at',
    ];

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
