<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'user_id', 'project_id'];
    public static $status = ['todo', 'in_progress', 'done', 'tested', 'deployed'];
    public function project()
    {
        return $this->belongsTo(project::class);
    }
}
