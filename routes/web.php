<?php

use App\Livewire\Exam\AddExam;
use App\Livewire\Exam\EditExam;
use App\Livewire\Exam\ExamList;
use App\Livewire\Exercise\Index;
use App\Livewire\Settings\Profile;
use App\Livewire\Exam\RecordGrades;
use App\Livewire\Settings\Password;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Settings\Appearance;
use App\Livewire\Subjects\AddSubject;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Exercise\AddExercise;
use App\Livewire\Exercise\ManageMarks;
use App\Livewire\Subjects\EditSubject;
use App\Livewire\Subjects\SubjectList;
use App\Livewire\Exercise\EditExercise;
use App\Livewire\ReportCard\Reportlist;
use App\Livewire\Teacher\Grades\AddGrade;
use App\Http\Controllers\ReportController;
use App\Livewire\Teacher\Grades\EditGrade;
use App\Livewire\Teacher\Grades\GradeList;
use App\Livewire\Reports\StudentPerformance;
use App\Livewire\Teacher\Students\AddStudent;
use App\Http\Controllers\ReportCardController;
use App\Livewire\Teacher\Students\EditStudent;
use App\Livewire\Teacher\Students\StudentList;
use App\Livewire\Teacher\Attendance\AttendancePage;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Generic dashboard route that redirects based on user role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'teacher') {
        return redirect()->route('teacher.dashboard');
    }

    return redirect('/'); // fallback for other roles
})->middleware(['auth', 'verified'])->name('dashboard');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified','teacher'])
    ->name('teacher.dashboard');



Route::middleware(['auth'])->group(function () {
    //attendance
    Route::get('/attendance', AttendancePage::class)->name('attendance.index');

    //Exercises
    Route::get('/exercises', Index::class)->name('exercise.index');
    Route::get('/exercises/{exercise}/marks', ManageMarks::class)->name('exercise.marks');
    Route::get('/create/exercise', AddExercise::class)->name('exercise.create');
    Route::get('/edit/exercise/{id}', EditExercise::class)->name('exercise.edit');

    //Performance Report
    Route::get('/reports/performance', StudentPerformance::class)->name('reports.performance');

    //Export
    Route::get('/reports/performance/export/{gradeId}', [ReportController::class, 'exportPerformance'])->name('reports.performance.export');

    //Exam
    Route::get('/exam/exam-list', ExamList::class)->name('exam.index');
    Route::get('/create/exam', AddExam::class)->name('exam.create');
    Route::get('/exam/{exam}/grades', RecordGrades::class)->name('exam.record');
    Route::get('/edit/exam/{id}', EditExam::class)->name('exam.edit');

    //ReportCard
    Route::get('/report-card', Reportlist::class)->name('report-card.index');
    Route::get('/report-card/download/{student}/{term}', [ReportCardController::class, 'download'])->name('report-card.download');
    
});



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

//Adding route for admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard',AdminDashboard::class)->name('admin.dashboard');

    //Student
    Route::get('/student-list', StudentList::class)->name('student.index');
    Route::get('/create/student', AddStudent::class)->name('student.create');
    Route::get('/edit/student/{id}', EditStudent::class)->name('student.edit');

    //grades
    Route::get('/grades/list', GradeList::class)->name('grade.index');
    Route::get('/create/grade', AddGrade::class)->name('grade.create');
    Route::get('/edit/grade/{id}', EditGrade::class)->name('grade.edit');

    //Subject
    Route::get('/subjects/list', SubjectList::class)->name('subject.index');
    Route::get('/create/subject', AddSubject::class)->name('subject.create');
    Route::get('/edit/subject/{id}', EditSubject::class)->name('subject.edit');

});


require __DIR__.'/auth.php';
