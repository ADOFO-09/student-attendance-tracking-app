<?php

namespace App\Livewire\Exercise;

use App\Models\Grade;
use App\Enums\TermEnum;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Exercise;
use App\Models\AcademicYear;
use Masmerise\Toaster\Toaster;
use Illuminate\Validation\Rule;

class EditExercise extends Component
{
    public $exercise;
    public $editId;
    public $editTitle;
    public $editSubjectId;
    public $editGradeId;
    public $editTerm;
    public $editDate;
    public $editAcademicYearId;

    public function mount($id)
    {
        $this->exercise = Exercise::findOrFail($id);

        $this->fill([
            'editTitle' => $this->exercise->title,
            'editSubjectId' => $this->exercise->subject_id,
            'editGradeId' => $this->exercise->grade_id,
            'editTerm' => $this->exercise->term,
            'editDate' => $this->exercise->date,
            'editAcademicYearId' => $this->exercise->academic_year_id,
        ]);
 
    }

    public function updateExercise()
    {
        $this->validate([
            'editTitle' => 'required|string',
            'editSubjectId' => 'required|exists:subjects,id',
            'editGradeId' => 'required|exists:grades,id',
            'editTerm' => ['required', Rule::in(TermEnum::values())],
            'editDate' => 'required|date',
            'editAcademicYearId' => 'required|exists:academic_years,id',
        ]);

        $this->exercise->update([
            'title' => $this->editTitle,
            'subject_id' => $this->editSubjectId,
            'grade_id' => $this->editGradeId,
            'term' => $this->editTerm,
            'date' => $this->editDate,
            'academic_year_id' => $this->editAcademicYearId,
        ]);

        Toaster::success('Exercise updated successfully!');
        
        return redirect()->route('exercise.index');
    }

    public function cancelEdit()
    {
        return redirect()->route('exercise.index');
    }
    public function render()
    {
        return view('livewire.exercise.edit-exercise', [
            'subjects' => Subject::all(),
            'grades' => Grade::all(),
            'academicYears' => AcademicYear::all()
        ]);
    }
}
