<?php

namespace App\Livewire\Reports;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use App\Models\ExerciseMark;

class StudentPerformance extends Component
{
    public $gradeId;
    public $grades;
    public $students = [];

    public function mount()
    {
        $this->grades = Grade::all();
    }

    public function updatedGradeId()
    {
        $this->students = Student::where('grade_id', $this->gradeId)->get();
    }

    public function getStudentStats($studentId)
    {
        $marks = ExerciseMark::where('student_id', $studentId)->get();

        if ($marks->count() == 0) return [0, 0, 'N/A'];

        $total = $marks->sum('total_score');
        $scored = $marks->sum('score');
        $average = $scored / $total * 100;

        $rating = match (true){
            $average >= 90 => 'Excellent',
            $average >= 75 => 'Very Good',
            $average >= 60 => 'Good',
            $average >= 50 => 'Fair',
            default => 'Needs Improvement',
        };

        return [round($average, 2), $marks->count(), $rating];
    }


    public function render()
    {
        return view('livewire.reports.student-performance');
    }
}
