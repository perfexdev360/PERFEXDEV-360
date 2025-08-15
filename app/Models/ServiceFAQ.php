<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceFAQ extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Service the FAQ belongs to.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
