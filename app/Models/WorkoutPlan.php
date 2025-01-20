<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'workoutplans';

    // The primary key associated with the table
    protected $primaryKey = 'workoutplan_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The data type of the auto-incrementing ID
    protected $keyType = 'int';
    protected $fillable = [
        'course_name',
        'course_type',
        'schedule',
        'duration',
        'requirement',
        'price',
        'course_description',
        'course_image',
        'id',
    
    ];
    // The attributes that are mass assignable
    // protected $guarded = [];

    // The attributes that should be cast to native types
    protected $casts = [
        'course_name' => 'string',
        'course_type' => 'string',
        'schedule' => 'string',
        'duration' => 'string',
        'requirement' => 'string',
        'price' => 'decimal:2',
        'course_description' => 'string',
        'course_image' => 'string',
        'id' => 'integer',
    ];

    // The attributes that should be mutated to dates
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Define the relationship with the User model
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }

    public function coach()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
