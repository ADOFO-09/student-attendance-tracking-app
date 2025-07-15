<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\ExamResult;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'subject_id', 'grade_id', 'term', 'total_marks', 'pass_marks', 'date'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
}
