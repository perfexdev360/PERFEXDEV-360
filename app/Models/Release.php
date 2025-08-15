<?php

namespace App\Models;

use App\Services\FeedService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Release extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'notes' => 'array',
        'forced_update' => 'boolean',
        'released_at' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function releaseChannel(): BelongsTo
    {
        return $this->belongsTo(ReleaseChannel::class);
    }

    public function fileArtifacts(): HasMany
    {
        return $this->hasMany(FileArtifact::class);
    }

    protected static function booted(): void
    {
        static::saved(function (Release $release) {
            if ($release->is_published) {
                app(FeedService::class)->updateProductFeed($release->product);
            }
        });
    }
}
