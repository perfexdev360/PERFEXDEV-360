<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileArtifact extends Model
{
    protected $fillable = [
        'release_id',
        'path',
        'size',
        'hash',
        'signature',
    ];

    public function release(): BelongsTo
    {
        return $this->belongsTo(Release::class);
    }
}
