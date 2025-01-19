<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'resources';

    // The primary key associated with the table
    protected $primaryKey = 'resource_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The "type" of the auto-incrementing ID
    protected $keyType = 'int';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    protected $guarded = [];
}
