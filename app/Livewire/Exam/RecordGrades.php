<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\Student;
use Livewire\Component;
use App\Models\ExamResult;
use Masmerise\Toaster\Toaster;

class RecordGrades extends Component
{
    public $exam;
    public $students = [];
    public $grades = [];

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->students = Student::where('grade_id', $exam->grade_id)->get();

        foreach($this->students as $student){
            $existing = ExamResult::where('exam_id', $exam->id)
                ->where('student_id', $student->id)
                ->first();
            
            $this->grades[$student->id] = [
                'marks_obtained' => $existing->marks_obtained ?? null,
            ];
        }
    }

    public function save()
    {
        foreach($this->grades as $studentId => $input){
             $marks = $input['marks_obtained'];
             $remarks = $this->rate($marks);

             ExamResult::updateOrCreate(
                ['exam_id' => $this->exam->id, 'student_id' => $studentId],
                ['marks_obtained' => $marks, 'remarks' => $remarks]
             );
        }

        Toaster::success('Grades recorded successfully!');
    }

    public function rate($score)
    {
        if (!$score) return 'Incomplete' ;

        $percent = ($score / $this->exam->total_marks) * 100;

        return match (true) {
            $percent >= 90 => 'Excellent',
            $percent >= 75 => 'Very Good',
            $percent >= 60 => 'Good',
            $percent >= 50 => 'Fair',
            default => 'Needs Improvement',
        }
    }
    public function render()
    {
        return view('livewire.exam.record-grades');
    }
}
