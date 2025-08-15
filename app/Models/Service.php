<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Options available for the service.
     */
    public function options(): HasMany
    {
        return $this->hasMany(ServiceOption::class);
    }

    /**
     * Frequently asked questions for the service.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFAQ::class);
    }

    /**
     * Related case studies.
     */
    public function caseStudies(): BelongsToMany
    {
        return $this->belongsToMany(CaseStudy::class);
    }

    /**
     * Gather tag-like identifiers for the service for matching.
     */
    public function tags(): Collection
    {
        return collect([$this->category])
            ->filter()
            ->map(fn ($tag) => Str::slug($tag))
            ->merge($this->options->pluck('slug'));
    }
}
