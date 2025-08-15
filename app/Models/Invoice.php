<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'number',
        'subtotal',
        'discount_total',
        'tax_total',
        'grand_total',
        'status',
        'due_at',
    ];

    /**
     * The order this invoice belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Payments made against the invoice.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Mark invoice as paid.
     */
    public function markPaid(): void
    {
        $this->status = 'paid';
        $this->save();
    }
}
