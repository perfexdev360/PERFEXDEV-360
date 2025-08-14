<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileArtifact extends Model
{
    protected $fillable = [
        'version_id',
        'path',
        'size',
        'hash',
        'signature',
    ];

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }
}
