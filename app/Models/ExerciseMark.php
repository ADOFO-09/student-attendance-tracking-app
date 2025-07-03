<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseMark extends Model
{
    protected $fillable = [
        'exercise_id',
        'student_id',
        'score',
        'total_score',
        'remarks',
    ];
    
    public function exercise(){
        return $this->belongsTo(Exercise::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
