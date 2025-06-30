<?php

namespace App\Livewire\Exercise;

use App\Models\Grade;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Exercise;
use Masmerise\Toaster\Toaster;

class AddExercise extends Component
{
    public $newTitle = ''; 
    public $newSubjectId = ''; 
    public $newDate = '';
    public $newGradeId = '';

    public $grades = [];

    public $subjects = [];

    public function mount(){
        $this->grades = Grade::all(); 
        $this->subjects = Subject::all();
    }

    
    public function createExercise(){
        $this->validate([
            'newTitle' => 'required|string|max:255',
            'newSubjectId' => 'required|exists:subjects,id',
            'newGradeId' => 'required|exists:grades,id',
            'newDate' => 'required|date',
        ]);

        Exercise::create([
            'title' => $this->newTitle,
            'subject_id' => $this->newSubjectId,
            'grade_id' => $this->newGradeId,
            'date' => $this->newDate,
        ]);

        $this->reset(['newTitle', 'newSubjectId', 'newGradeId', 'newDate']);
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
