<?php

namespace App\Livewire\Teacher\Attendance;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Masmerise\Toaster\Toaster;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AttendancePage extends Component
{
    public $year, $month, $grade;

    public $students = [];

    public $attendance = [];

    public $grades = [];

    public function mount(){
        $this->grades = Grade::all();
    }

    public function fetchStudents(){
        if($this->year && $this->month && $this->grade){
            $this->students = Student::where('grade_id', $this->grade)->get();
            //generate days in a month
            foreach ($this->students as $student) {
                foreach(range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
                    $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                    $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)
                        ->where('date', $date)
                        ->value('status') ?? 'present'; // default to 'present' if no record found

                }
            }
        }
    }

    public function updateAttendance($studentId, $day, $status){
        $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
        $attendance = Attendance::updateOrCreate(
            ['student_id' => $studentId, 'date' => $date],
            [
                'status' => $status,
                'grade_id' => $this->grade
            ]
        );
         //sync the state of status
        $this->attendance[$studentId][$day] = $status;

        Toaster::success('Attendance for date:'.$date. ' for studentID '. $studentId.' was updated successfully.');
    }

    public function markAll($day, $status){
        foreach($this->students as $student){
            $this->updateAttendance($student->id, $day, $status);
        }
    }

    public function exportToExcel(){
       return Excel::download(new AttendanceExport($this->year, $this->month, $this->grade), 'attendance.xlsx');
    }

    public function render()
    {
        $this->fetchStudents();
        return view('livewire.teacher.attendance.attendance-page',[
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth
        ]);
    }
}
