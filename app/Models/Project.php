<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $guarded = [];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function projectCode() {
        return $this->belongsTo(ProjectCode::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
