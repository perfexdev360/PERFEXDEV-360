<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Models\Setting;

class Meeting extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Meeting $meeting): void {
            if ($meeting->provider === 'google_meet' && empty($meeting->url)) {
                $template = Setting::firstWhere('key', 'google_meet_template')?->value
                    ?? 'https://meet.google.com/{code}';
                $code = Str::lower(Str::random(3)) . '-' . Str::lower(Str::random(4)) . '-' . Str::lower(Str::random(3));
                $meeting->url = str_replace('{code}', $code, $template);
            }
        });
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
