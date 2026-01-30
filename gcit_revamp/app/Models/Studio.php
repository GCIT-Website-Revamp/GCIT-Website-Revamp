<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    //
    protected $casts = [
        'roles' => 'array',
    ];
}
