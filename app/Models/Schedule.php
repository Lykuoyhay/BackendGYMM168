<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'schedules';

    // The primary key associated with the table
    protected $primaryKey = 'schedule_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The "type" of the auto-incrementing ID
    protected $keyType = 'int';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'room_name',
        'id',
        'workoutplan_id'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    // Define the relationship with the WorkoutPlan model
    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class, 'workoutplan_id', 'workoutplan_id');
    }
}
