<?php

namespace App\Livewire\Exercise;

use Livewire\Component;
use App\Models\Exercise;

class Index extends Component
{
    public $exercises;

    public function mount()
    {
        $this->exercises = Exercise::with(['subject', 'grade'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.exercise.index');
    }
}
