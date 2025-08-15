<?php

namespace App\Models;

use App\Mail\PaymentReceipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;

class Payment extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'provider',
        'provider_txn_id',
        'amount',
        'currency',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (Payment $payment): void {
            $invoice = $payment->invoice;

            if ($payment->status === 'succeeded' && $invoice) {
                $invoice->markPaid();

                // Update associated license
                if ($invoice->order && $invoice->order->license) {
                    $invoice->order->license->touch();
                }

                // Send receipt email
                if ($invoice->order && $invoice->order->user) {
                    Mail::to($invoice->order->user->email)
                        ->send(new PaymentReceipt($payment));
                }
            }
        });
    }

    /**
     * Payment belongs to an invoice.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
