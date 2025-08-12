<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
