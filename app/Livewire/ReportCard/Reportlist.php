<?php

namespace App\Livewire\ReportCard;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;

class Reportlist extends Component
{
    public $gradeId;
    public $term;
    public $grades;
    public $students = [];

    public function mount()
    {
        $this->grades = Grade::all();
    }
    
    public function updatedGradeId()
    {
        $this->loadStudents();
    }
    
    public function updatedTerm()
    {
        $this->loadStudents();
    }

    public function loadStudents()
    {
        if ($this->gradeId && $this->term) {
            $this->students = Student::where('grade_id', $this->gradeId)->get();
        }else{
            $this->students = [];
        }
    }
    public function render()
    {
        return view('livewire.report-card.reportlist');
    }
}
