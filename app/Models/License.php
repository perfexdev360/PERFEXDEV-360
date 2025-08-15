<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    use HasFactory;

    public const TYPE_SINGLE = 'single';
    public const TYPE_MULTI = 'multi';
    public const TYPE_ENTERPRISE = 'enterprise';

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'update_window_ends_at' => 'datetime',
        'is_revoked' => 'boolean',
        'duration_days' => 'integer',
    ];

    public function activations(): HasMany
    {
        return $this->hasMany(LicenseActivation::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(LicenseEvent::class);
    }

    public function activationHistory(): HasMany
    {
        return $this->events()->whereIn('event', ['activated', 'rotated']);
    }
}
