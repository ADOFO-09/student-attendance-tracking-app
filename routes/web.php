<?php

use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Teacher\Grades\AddGrade;
use App\Livewire\Teacher\Grades\EditGrade;
use App\Livewire\Teacher\Grades\GradeList;
use App\Livewire\Teacher\Students\AddStudent;
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
});


require __DIR__.'/auth.php';
