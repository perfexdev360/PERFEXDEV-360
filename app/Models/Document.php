<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['signed_url'];

    protected $casts = [
        'meta' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (Document $document) {
            if ($document->version) {
                return;
            }

            $max = static::where('user_id', $document->user_id)
                ->where('type', $document->type)
                ->max('version');

            $document->version = $max ? $max + 1 : 1;
        });
    }

    public function getSignedUrlAttribute(): string
    {
        return Storage::temporaryUrl($this->path, now()->addMinutes(30));
    }
}

