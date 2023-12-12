<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->projects->contains(request()->route()->parameter('project'));
    }


    public function view(User $user, Task $task): bool
    {
        return $task->project->users->contains($user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $task->project->users->contains($user);
    }

    public function delete(User $user, Task $task): bool
    {
        return $task->project->users->contains($user);
    }

    // public function restore(User $user, Task $task): bool
    // {
    //     //
    // }

    // public function forceDelete(User $user, Task $task): bool
    // {
    //     //
    // }
}
