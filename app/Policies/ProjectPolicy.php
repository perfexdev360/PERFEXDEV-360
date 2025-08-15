<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any projects.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'client'], true);
    }

    /**
     * Determine whether the user can view a project.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can create projects.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'client'], true);
    }

    /**
     * Determine whether the user can update the project.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $project->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the project.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $project->user_id === $user->id;
    }
}
