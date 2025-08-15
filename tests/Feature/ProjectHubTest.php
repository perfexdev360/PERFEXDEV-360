<?php

use App\Models\{Project, ProjectActivity, ProjectDiscussion, ProjectFile, Task, Milestone, User};

it('associates project resources', function () {
    $user = User::factory()->create();

    $project = Project::create([
        'name' => 'Demo',
        'user_id' => $user->id,
    ]);

    $project->milestones()->create(['title' => 'Phase 1']);
    $project->tasks()->create(['title' => 'Initial task']);
    $project->files()->create(['path' => '/tmp/test.txt', 'original_name' => 'test.txt']);
    $project->discussions()->create(['user_id' => $user->id, 'body' => 'Kickoff']);
    $project->activities()->create(['type' => 'created']);

    expect($project->milestones)->toHaveCount(1)
        ->and($project->tasks)->toHaveCount(1)
        ->and($project->files)->toHaveCount(1)
        ->and($project->discussions)->toHaveCount(1)
        ->and($project->activities)->toHaveCount(1);
});
