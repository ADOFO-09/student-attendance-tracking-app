<?php

namespace App\Livewire\Exercise;

use App\Models\Grade;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Exercise;
use Masmerise\Toaster\Toaster;

class EditExercise extends Component
{
    public $exercise;
    public $editId;
    public $editTitle;
    public $editSubjectId;
    public $editGradeId;
    public $editTerm;
    public $editDate;

    public function mount($id)
    {
        $this->exercise = Exercise::findOrFail($id);

        $this->fill([
            'editTitle' => $this->exercise->title,
            'editSubjectId' => $this->exercise->subject_id,
            'editGradeId' => $this->exercise->grade_id,
            'editTerm' => $this->exercise->term,
            'editDate' => $this->exercise->date,
        ]);
 
    }

    public function updateExercise()
    {
        $this->validate([
            'editTitle' => 'required|string',
            'editSubjectId' => 'required|exists:subjects,id',
            'editGradeId' => 'required|exists:grades,id',
            'editTerm' => 'required|string|max:50',
            'editDate' => 'required|date',
        ]);

        $this->exercise->update([
            'title' => $this->editTitle,
            'subject_id' => $this->editSubjectId,
            'grade_id' => $this->editGradeId,
            'term' => $this->editTerm,
            'date' => $this->editDate,
        ]);

        Toaster::success('Exercise updated successfully!');
        
        return redirect()->route('exercise.index');
    }

    public function cancelEdit()
    {
        return redirect()->route('exercise.index');
    }
    public function render()
    {
        return view('livewire.exercise.edit-exercise', [
            'subjects' => Subject::all(),
            'grades' => Grade::all(),
        ]);
    }
}
