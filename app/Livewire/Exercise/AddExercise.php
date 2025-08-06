<?php

namespace App\Livewire\Exercise;

use App\Models\Grade;
use App\Enums\TermEnum;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Exercise;
use App\Models\AcademicYear;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;

class AddExercise extends Component
{
    public $newTitle = ''; 
    public $newSubjectId = ''; 

    public $academicYearId;
    public $newDate = '';
    public $newGradeId = '';

    public $newTerm = '';

    public $grades = [];

    public $subjects = [];

    public $academicYears = [];

    public function mount(){
        $this->grades = Grade::all(); 
        $this->subjects = Subject::all();
        $this->academicYears = AcademicYear::all();
    }

    
    public function createExercise(){
        $this->validate([
            'newTitle' => 'required|string|max:255',
            'newSubjectId' => 'required|exists:subjects,id',
            'newGradeId' => 'required|exists:grades,id',
            'newTerm' => ['required', Rule::in(TermEnum::values())],
            'newDate' => 'required|date',
            'academicYearId' => 'required|exists:academic_years,id',
        ]);

        Exercise::create([
            'title' => $this->newTitle,
            'subject_id' => $this->newSubjectId,
            'grade_id' => $this->newGradeId,
            'term' => $this->newTerm,
            'date' => $this->newDate,
            'academic_year_id' => $this->academicYearId,
        ]);

        $this->reset(['newTitle', 'newSubjectId', 'newGradeId','newTerm','newDate','academicYearId']);
        Toaster::success('Exercise created successfully!');
        return redirect()->route('exercise.index');
    }

    public function cancelCreate()
    {
        return redirect()->route('exercise.index');
    }

    public function render()
    {
        return view('livewire.exercise.add-exercise');
    }
}
