<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
#[Title('Student Attendance | Add Grade')]

class AddGrade extends Component
{
    public $name = '';

    public function mount(){
        $this->grades = Grade::all();
    }

    public function save(){
        $this->validate([
            'name' => 'required|string',
        ]);

        Grade::create([
            'name' => $this->name,
        ]);

        $this->reset();

        Toaster::success('Grade added successfully');

        return redirect()->route('grade.index');
    }

    public function render()
    {
        return view('livewire.teacher.grades.add-grade');
    }
}
