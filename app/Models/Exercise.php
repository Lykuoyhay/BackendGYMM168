<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'exercises';

    // The primary key associated with the table
    protected $primaryKey = 'exercise_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The "type" of the auto-incrementing ID
    protected $keyType = 'int';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'exercise_name',
        'exercise_type',
        'exercise_muscle',
        'exercise_equipment',
        'exercise_difficulty',
        'exercise_description',
        'exercise_cover' 
    ];
}
