<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOption extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'config' => 'array',
    ];

    /**
     * Service this option belongs to.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
