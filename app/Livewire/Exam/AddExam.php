<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\Grade;
use App\Enums\TermEnum;
use App\Models\AcademicYear;
use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;

class AddExam extends Component
{
    public $title, $subject_id, $grade_id, $term, $date,$academic_year_id ,$total_marks = 100, $pass_mark = 40;

    public $academicYears = [];
    public $subjects = [];
    public $grades = [];

    public function mount()
    {
       $this->subjects = Subject::all();
       $this->grades = Grade::all();
       $this->academicYears = AcademicYear::all();
    }

    public function createExam()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'term' => ['required', Rule::in(TermEnum::values())],
            'date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'pass_mark' => 'required|integer|min:0|max:' . $this->total_marks,
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Exam::create([
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'grade_id' => $this->grade_id,
            'term' => $this->term,
            'date' => $this->date,
            'total_marks' => $this->total_marks,
            'pass_mark' => $this->pass_mark,
            'academic_year_id' => $this->academic_year_id
        ]);

        $this->reset(['title', 'subject_id', 'grade_id', 'term', 'date', 'total_marks', 'pass_mark','academic_year_id']);

        Toaster::success('Exam created successfully!');
        return redirect()->route('exam.index');
    }
    public function render()
    {
        return view('livewire.exam.add-exam');
    }
}
