<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditExam extends Component
{
    public $exam;
    public $title, $subject_id, $grade_id, $term, $date, $total_marks, $pass_mark;
    public $subjects = [];
    public $grades = [];

    public function mount($id)
    {
        $this->exam = Exam::findOrFail($id);

        $this->title = $this->exam->title;
        $this->subject_id = $this->exam->subject_id;
        $this->grade_id = $this->exam->grade_id;
        $this->term = $this->exam->term;
        $this->date = $this->exam->date;
        $this->total_marks = $this->exam->total_marks;
        $this->pass_mark = $this->exam->pass_marks;

        $this ->subjects = Subject::all();
        $this ->grades = Grade::all();
    }

    public function updateExam()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'term' => 'required|string|max:255',
            'date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'pass_mark' => ['required', 'integer', 'min:0', 'max:' . $this->total_marks],

        ]);

        $this->exam->update([
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'grade_id' => $this->grade_id,
            'term' => $this->term,
            'date' => $this->date,
            'total_marks' => $this->total_marks,
            'pass_mark' => $this->pass_mark,
        ]);

        Toaster::success('Exam updated successfully.');
        return redirect()->route('exam.index');
    }
    public function render()
    {
        return view('livewire.exam.edit-exam');
    }
}
