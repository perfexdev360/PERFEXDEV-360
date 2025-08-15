<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
