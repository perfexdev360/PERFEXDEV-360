<?php

namespace App\Models;

use App\Notifications\MilestoneCompleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::updated(function (Milestone $milestone) {
            if ($milestone->isDirty('status') && $milestone->status === 'done') {
                $milestone->project->user?->notify(new MilestoneCompleted(
                    "Milestone '{$milestone->title}' completed"
                ));
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

