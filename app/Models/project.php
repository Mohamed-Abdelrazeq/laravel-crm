<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id'];
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'projects_users', 'project_id', 'user_id')
            ->withTimestamps()
            ->as('project_users');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'project_id');
    }
}
