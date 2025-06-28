<?php

namespace App\Livewire\Exercise;

use Livewire\Component;
use App\Models\Exercise;
use Masmerise\Toaster\Toaster;

class EditExercise extends Component
{
    public $exercise;
    public function updateExercise()
    {
        $this->validate([
            'editTitle' => 'required|string',
            'editSubjectId' => 'required|exists:subjects,id',
            'editDate' => 'required|date',
        ]);

        $exercise = Exercise::findOrFail($this->editId);
        $exercise->update([
            'title' => $this->editTitle,
            'subject_id' => $this->editSubjectId,
            'date' => $this->editDate,
        ]);

        Toaster::success('Exercise updated successfully!');
        
        return redirect()->route('exercise.index');
    }
    public function render()
    {
        return view('livewire.exercise.edit-exercise');
    }
}
