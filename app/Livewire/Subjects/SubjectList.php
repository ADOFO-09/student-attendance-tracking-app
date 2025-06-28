<?php

namespace App\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SubjectList extends Component
{
     public function delete($id){
        Subject::find($id)->delete();
        Toaster::success('Subject deleted successfully');

        return redirect()->route('subject.index');

    }

    public function render()
    {
        return view('livewire.subjects.subject-list',[
            'subjects' => Subject::all()
        ]);
    }
}
