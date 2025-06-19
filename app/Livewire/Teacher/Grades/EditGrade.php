<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditGrade extends Component
{

    public $grade_details;
    public $name='';

    public function mount($id){
        $this->grade_details = Grade::find($id);

        $this->fill([
            'name' => $this->grade_details->name
        ]);

    }

    public function update(){
        $this->validate([
            'name' => 'required|string'
        ]);

        $this->grade_details->update([
            'name' => $this->name,
        ]);

        Toaster::success('Grade name updated successfully');

        return redirect()->route('grade.index');
    }


    public function render()
    {
        return view('livewire.teacher.grades.edit-grade');
    }
}
