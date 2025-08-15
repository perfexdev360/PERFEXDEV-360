<?php

namespace App\Models;

use App\Notifications\QuoteApproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Invoice;
use App\Models\User;
use App\Models\QuoteItem;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
        'valid_until' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Quote belongs to a user (client).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function recalculateTotals(): void
    {
        $subtotal = $this->items->sum(fn ($item) => $item->qty * $item->unit_price);
        $discount = $this->items->sum('discount');
        $tax = $this->items->sum(fn ($item) => ($item->qty * $item->unit_price - $item->discount) * ($item->tax_rate / 100));

        $this->subtotal = $subtotal;
        $this->discount_total = $discount;
        $this->tax_total = $tax;
        $this->grand_total = $subtotal - $discount + $tax;
        $this->save();
    }

    /**
     * Approve the quote, create an invoice and notify the user.
     */
    public function approve(string $name, string $ip): Invoice
    {
        // Ensure totals are current before approval
        $this->recalculateTotals();

        $this->status = 'approved';
        $meta = $this->meta ?? [];
        $meta['signature'] = [
            'name' => $name,
            'signed_at' => now(),
            'ip_hash' => hash('sha256', $ip),
        ];
        $this->meta = $meta;
        $this->save();

        $invoice = Invoice::create([
            'order_id'       => $this->id, // simplistic mapping
            'number'         => 'INV-' . $this->number,
            'subtotal'       => $this->subtotal ?? 0,
            'discount_total' => $this->discount_total ?? 0,
            'tax_total'      => $this->tax_total ?? 0,
            'grand_total'    => $this->grand_total ?? 0,
        ]);

        if ($this->user) {
            $this->user->notify(new QuoteApproved($this, $invoice));
        }

        return $invoice;
    }
}
