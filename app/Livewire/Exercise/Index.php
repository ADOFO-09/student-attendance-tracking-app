<?php

namespace App\Livewire\Exercise;

use Livewire\Component;
use App\Models\Exercise;
use Masmerise\Toaster\Toaster;

class Index extends Component
{
    public $exercises;
    public $showCreateForm = false;
    public $newTitle, $newSubjectId, $newDate;
    public $editId, $editTitle, $editSubjectId, $editDate;


    protected $listeners = ['editExercise' => 'loadExercise'];

    public function loadExercise($id)
    {
        $exercise = Exercise::findOrFail($id);
        $this->editId = $id;
        $this->editTitle = $exercise->title;
        $this->editSubjectId = $exercise->subject_id;
        $this->editDate = $exercise->date;
    }

    

    //Update an existing exercise
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
        $this->reset(['editId', 'editTitle', 'editSubjectId', 'editDate']);
        $this->mount();
    }

    //Delete an exercise
    public function deleteExercise($id)
    {
        Exercise::findOrFail($id)->delete();
        Toaster::success('Exercise deleted successfully!');
        $this->mount();
    }

    public function mount()
    {
        $this->exercises = Exercise::with(['subject', 'grade'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.exercise.index');
    }
}
