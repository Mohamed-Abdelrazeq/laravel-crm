<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'owner_id'];
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'projects_users', 'project_id', 'user_id')
            ->as('user_projects');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'project_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'project_id');
    }
}
