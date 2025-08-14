<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseEvent extends Model
{
    protected $fillable = [
        'license_id',
        'event',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}
