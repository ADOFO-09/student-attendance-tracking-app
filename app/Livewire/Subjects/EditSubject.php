<?php

namespace App\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditSubject extends Component
{
    public $subject_details;
    public $name = '';

    public function mount($id){
        $this->subject_details = Subject::find($id);
        
        $this->fill([
            'name' => $this->subject_details->name
        ]);
    }

    public function update(){
        $this->validate([
            'name' => 'required|string'
        ]);

        $this->subject_details->update([
            'name' => $this->name,
        ]);

        Toaster::success('Subject name updated successfully');

        return redirect()->route('subject.index');
    }
    public function render()
    {
        return view('livewire.subjects.edit-subject');
    }
}
