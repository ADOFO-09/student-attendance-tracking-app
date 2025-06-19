<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function marks(){
        return $this->hasMany(ExerciseMark::class);
    }
}
