<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function project(){
        return $this->hasMany(Project::class);
    }
}
