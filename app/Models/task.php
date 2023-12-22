<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'project_id',
        'assigned_to',
        'created_by'
    ];

    protected $attributes = [
        'status' => 'todo',
    ];

    public static $status = [
        'todo',
        'in_progress',
        'done',
        'tested',
        'deployed',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_tasks', 'task_id', 'tag_id');
    }
}
