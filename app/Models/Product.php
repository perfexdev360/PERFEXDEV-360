<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function releases()
    {
        return $this->hasMany(Release::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
