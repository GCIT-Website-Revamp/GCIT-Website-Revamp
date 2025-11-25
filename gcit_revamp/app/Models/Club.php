<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name', 'description', 'roles'];

    // Automatically convert roles array to JSON when saving, and JSON to array when reading
    protected $casts = [
        'roles' => 'array',
    ];
}
