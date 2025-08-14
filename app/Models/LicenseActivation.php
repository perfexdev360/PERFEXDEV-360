<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseActivation extends Model
{
    protected $fillable = [
        'license_id',
        'domain',
        'ip_hash',
        'fingerprint',
        'meta',
        'activated_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'activated_at' => 'datetime',
    ];

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}
