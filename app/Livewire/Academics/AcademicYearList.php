<?php

namespace App\Livewire\Academics;

use Livewire\Component;
use App\Models\AcademicYear;
use Masmerise\Toaster\Toaster;

class AcademicYearList extends Component
{
    public $academicyears = [];

    public function mount(){
        // Initialize the component, if needed
        $this->academicyears = AcademicYear::all();
    }
    public function delete($id){
        AcademicYear::find($id)->delete();
        Toaster::success('Academic Year deleted successfully');

        return redirect()->route('academicyear.index');
    }

    public function render()
    {
        return view('livewire.academics.academic-year-list',[
            'academicYears' => AcademicYear::all()
        ]);
    }
}
