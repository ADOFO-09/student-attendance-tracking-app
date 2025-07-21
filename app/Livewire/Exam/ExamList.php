<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ExamList extends Component
{
    public $exams;
    public $title, $subject_id, $term, $date, $total_marks = 100, $pass_mark = 40;

    public function mount()
    {
        $this->exams = Exam::with(['grade', 'subject'])->latest()->get();
    }

    public function deleteExam($id)
    {
        Exam::findOrFail($id)->delete();
        Toaster::success('Exam deleted successfully!');
        $this->mount();
    }
    public function render()
    {
        return view('livewire.exam.exam-list');
    }
}
