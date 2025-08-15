<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\License;
use App\Models\Invoice;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
    ];

    /**
     * Order belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * License associated with the order.
     */
    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }
}
