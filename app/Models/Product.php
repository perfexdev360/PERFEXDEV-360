<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
