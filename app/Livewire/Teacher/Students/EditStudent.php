<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditStudent extends Component
{
    public $grades = [];
     public $first_name = '';
    public $last_name = '';
    public $age = '';
    public $grade = '';
    public $student_details;

    public function mount($id){
        $this->student_details = Student::find($id);

        $this->fill([
            'first_name' => $this->student_details->first_name,
            'last_name' => $this->student_details->last_name,
            'age' => $this->student_details->age,
            'grade' => $this->student_details->grade_id,
        ]);

        $this->grades = Grade::all();
    }

    public function update(){
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'grade' => 'required'
        ]);

        $this->student_details->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'grade_id' => $this->grade,
        ]);

        Toaster::success('Student updated successfully');

        return redirect()->route('student.index');


    }

    public function render()
    {
        return view('livewire.teacher.students.edit-student');
    }
}
