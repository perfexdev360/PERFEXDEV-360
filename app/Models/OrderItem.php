<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'edition_id',
        'qty',
        'unit_price',
        'tax_amount',
        'discount_amount',
        'total',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
