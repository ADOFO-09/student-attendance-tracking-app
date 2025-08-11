<?php

namespace App\Livewire\Academics;

use Livewire\Component;
use App\Models\AcademicYear;
use Masmerise\Toaster\Toaster;

class EditAcademicYear extends Component
{
    public $academicYearDetails;

    public $name = '';

    public function mount($id) {
        $this->academicYearDetails = AcademicYear::find($id);

        $this->fill([
            'name' => $this->academicYearDetails->name
        ]);
    }

    public function update() {
        $this->validate([
            'name' => 'required|string'
        ]);

        $this->academicYearDetails->update([
            'name' => $this->name,
        ]);

        Toaster::success('Academic Year updated successfully');

        return redirect()->route('academicyear.index');
    }
    public function render()
    {
        return view('livewire.academics.edit-academic-year');
    }
}
