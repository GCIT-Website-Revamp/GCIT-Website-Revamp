<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    //
    protected $casts = [
        'timeline' => 'array',
    ];
}
