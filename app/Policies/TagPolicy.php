<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;

class TagPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->projects->contains(request()->route()->parameter('project'));
    }

    public function view(User $user, Tag $tag): bool
    {
        // dd($tag->project_id == request()->route()->parameter('project')->id);
        return $user->projects->contains(request()->route()->parameter('project')) && $tag->project_id == request()->route()->parameter('project')->id;
    }

    public function create(User $user): bool
    {
        return $user->projects->contains(request()->route()->parameter('project'));

    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->projects->contains(request()->route()->parameter('project')) && $tag->project_id == request()->route()->parameter('project')->id;
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $user->projects->contains(request()->route()->parameter('project')) && $tag->project_id == request()->route()->parameter('project')->id;
    }

}
