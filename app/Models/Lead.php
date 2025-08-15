<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pipelineStage()
    {
        return $this->belongsTo(PipelineStage::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function tags(): Collection
    {
        $tags = collect(explode(',', (string) $this->tech_stack))
            ->map(fn ($tag) => trim(strtolower($tag)))
            ->filter();

        $optionTags = $this->serviceRequests
            ->flatMap(fn ($request) => array_keys($request->selected_options ?? []));

        return $tags->merge($optionTags)->unique();
    }
        public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'source',
        'notes',
        'pipeline_stage_id',
        'budget_min',
        'budget_max',
        'timeline',
        'tech_stack',
        'assigned_to_id',
    ];
    protected $casts = [
        'tech_stack' => 'string',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
    ];
}
