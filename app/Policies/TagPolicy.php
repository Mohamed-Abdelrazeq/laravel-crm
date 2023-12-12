<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->projects->contains(request()->route()->parameter('project'));
    }

    public function view(User $user, Project $project, Tag $tag): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;

    }

    public function update(User $user, Tag $tag): bool
    {
        return true;

    }

    public function delete(User $user, Tag $tag): bool
    {
        return true;

    }

}
