<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function guideTeam()
    {
        return $this->belongsTo(Team::class, 'guide', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
