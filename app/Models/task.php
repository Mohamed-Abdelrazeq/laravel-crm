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

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag', 'task_id', 'tag_id');
    }
}
