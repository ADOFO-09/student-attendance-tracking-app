<?php

namespace App\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;

#[Title('Student Attendance | Add Subject')]

class AddSubject extends Component
{
    public $name = '';

    public $subjects;

    public function mount(){
        $this->subjects = Subject::all();
    }

    public function save(){
        $this->validate([
            'name' => 'required|string',
        ]);

        Subject::create([
            'name' => $this->name,
        ]);

        $this->reset();

        Toaster::success('Subject added successfully');

        return redirect()->route('subject.index');
    }
    public function render()
    {
        return view('livewire.subjects.add-subject');
    }
}
