<?php

namespace App\Models;

use App\Notifications\QuoteApproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Invoice;
use App\Models\User;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

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

    /**
     * Approve the quote, create an invoice and notify the user.
     */
    public function approve(): Invoice
    {
        $this->status = 'approved';
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
