<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
        'license_key',
        'type',
        'activation_limit',
        'update_window_ends_at',
        'is_revoked',
    ];

    protected $casts = [
        'update_window_ends_at' => 'datetime',
        'is_revoked' => 'boolean',
    ];

    public function activations(): HasMany
    {
        return $this->hasMany(LicenseActivation::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(LicenseEvent::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
