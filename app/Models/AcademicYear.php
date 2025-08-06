<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ['name'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
