<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\License;

class Order extends Model
{
    /**
     * @var array<int, string>
     */
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

    /**
     * License associated with the order.
     */
    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }
}
