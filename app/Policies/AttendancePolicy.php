<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;

class AttendancePolicy
{
    public function viewAny(User $user)
    {
        return $user->projects->contains(request()->route()->parameter('project'));
    }

    public function view(User $user, Attendance $attendance)
    {
        return $attendance->project->users->contains($user);
    }

    public function create(User $user)
    {
        return $user->projects->contains(request()->route()->parameter('project'));
    }

    public function update(User $user, Attendance $attendance)
    {
        return $attendance->user_id === $user->id || $attendance->project->owner_id === $user->id;
    }

    public function delete(User $user, Attendance $attendance)
    {
        return $attendance->user_id === $user->id || $attendance->project->owner_id === $user->id;
    }
}
