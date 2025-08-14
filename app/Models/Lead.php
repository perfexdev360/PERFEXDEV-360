<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];
     * The attributes that are mass assignable.
     */
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
