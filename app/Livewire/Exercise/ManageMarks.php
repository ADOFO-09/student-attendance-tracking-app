<?php

namespace App\Livewire\Exercise;

use App\Models\Student;
use Livewire\Component;
use App\Models\Exercise;
use App\Models\ExerciseMark;
use Masmerise\Toaster\Toaster;

class ManageMarks extends Component
{
    public $exercise;
    public $students = [];
    public $marks = [];

    public function mount(Exercise $exercise)
    {
        $this->exercise = Exercise::findOrFail($exercise->id);
        $this->students = Student::where('grade_id', $exercise->grade_id)->get();

        foreach ($this->students as $student) {
            $existing = ExerciseMark::where('exercise_id', $exercise->id)
                                    ->where('student_id', $student->id)
                                    ->first();
            $this->marks[$student->id] = [
                'score' => $existing->score ?? null,
                'total_score' => $existing->total_score ?? null,
            ];
        }

    }

    
    public function save()
    {
        foreach ($this->marks as $studentId => $mark) {
            ExerciseMark::updateOrCreate(
                ['exercise_id' => $this->exercise->id, 'student_id' => $studentId],
                [
                    'score' => $mark['score'],
                    'total_score' => $mark['total_score'],
                    'remarks' => $this->ratePerformance($mark['score'], $mark['total_score']),
                ]
            );
        }
        Toaster::success('Marks saved successfully!');

        return redirect()->route('exercise.index');
    }

    public function ratePerformance($score, $total)
    {
        if (!$total || !$score) return 'incomplete';

        $percentage = ($score / $total) * 100;

        return match(true){
            $percentage >= 90 => 'Excellent',
            $percentage >= 75 => 'Very Good',
            $percentage >= 60 => 'Good',
            $percentage >= 50 => 'Fair',
            default => 'Needs Improvement',
        };
    }

    public function render()
    {
        return view('livewire.exercise.manage-marks');
    }
}
