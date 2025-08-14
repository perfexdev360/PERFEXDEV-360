<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
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
}
