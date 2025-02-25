<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCode extends Model
{
    public function project(){
        return $this->hasMany(Project::class);
    }
}
