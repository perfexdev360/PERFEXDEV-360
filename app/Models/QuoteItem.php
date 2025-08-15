<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteItem extends Model
{
    protected $guarded = [];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function getLineTotalAttribute(): float
    {
        return $this->qty * $this->unit_price - $this->discount;
    }

    public function getTaxAmountAttribute(): float
    {
        return $this->line_total * ($this->tax_rate / 100);
    }

    protected static function booted(): void
    {
        static::saved(function (QuoteItem $item): void {
            $item->quote?->recalculateTotals();
        });
        static::deleted(function (QuoteItem $item): void {
            $item->quote?->recalculateTotals();
        });
    }
}
