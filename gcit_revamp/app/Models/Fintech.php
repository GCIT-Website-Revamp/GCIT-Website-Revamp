<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fintech extends Model
{
    //
    protected $casts = [
        'roles' => 'array',
    ];
}
