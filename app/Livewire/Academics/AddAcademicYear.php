<?php

namespace App\Livewire\Academics;

use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;


#[Title('Student Attendance | Add Academic Year')]
class AddAcademicYear extends Component
{
    public $name = '';

    public $academicYears;

    public function mount(){
        $this->academicYears = AcademicYear::all();
    }

    public function save() {
        $this->validate([
            'name' => 'required|string',
        ]);

        AcademicYear::create([
            'name' => $this->name,
        ]);

        $this->reset();

        Toaster::success('Academic Year added successfully');

        return redirect()->route('academicyear.index');
    }
    public function render()
    {
        return view('livewire.academics.add-academic-year');
    }
}
