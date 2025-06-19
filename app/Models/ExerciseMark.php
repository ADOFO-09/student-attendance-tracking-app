<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseMark extends Model
{
    public function exercise(){
        return $this->belongsTo(Exercise::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
