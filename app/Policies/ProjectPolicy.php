<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        return $user->projects->contains($project) || $user->id === $project->owner_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

}
