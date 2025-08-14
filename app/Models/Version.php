<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function releaseChannel()
    {
        return $this->belongsTo(ReleaseChannel::class);
    }
}
