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
use App\Models\OrderItem;
use App\Models\TaxLine;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'number',
        'subtotal',
        'tax_total',
        'discount_total',
        'grand_total',
    ];

    protected $casts = [
        'billing_info' => 'array',
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

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function taxLines(): HasMany
    {
        return $this->hasMany(TaxLine::class);
    }

    /**
     * License associated with the order.
     */
    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }
}
