<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Lead;

class PipelineStage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Leads that currently reside in this stage.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
