<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'progresses';

    // The primary key associated with the table
    protected $primaryKey = 'progress_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The data type of the auto-incrementing ID
    protected $keyType = 'int';

    // The attributes that are mass assignable
    protected $fillable = [
        'workout_set', 
        'workout_duration', 
        'calories_burn', 
        'status', // Add status to fillable attributes
        'id'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'workout_set' => 'integer',
        'workout_duration' => 'integer',
        'calories_burn' => 'integer',
        'id' => 'integer',
    ];

    // The attributes that should be mutated to dates
    protected $dates = [
        'created_at', 
        'updated_at'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
