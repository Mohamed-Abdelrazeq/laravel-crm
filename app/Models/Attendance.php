<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_in', 'clock_out'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('clock_in', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('clock_in', today()->month);
    }

}
