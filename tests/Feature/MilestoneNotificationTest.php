<?php

use App\Models\Milestone;
use App\Models\Project;
use App\Models\User;
use App\Notifications\MilestoneCompleted;
use Illuminate\Support\Facades\Notification;

it('notifies user when milestone is completed', function () {
    Notification::fake();

    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();
    $milestone = Milestone::factory()->for($project)->create([
        'status' => 'open',
    ]);

    $milestone->update(['status' => 'done']);

    Notification::assertSentTo($user, MilestoneCompleted::class);
});

