<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/attendance', AttendanceController::class);

Route::get('/new_student', [studentController::class, 'newstudent']);

Route::post('/addstudent', [studentController::class, 'storestudent']);

Route::get('/course', [CourseController::class, 'course']);

Route::get('/add_course', [CourseController::class, 'addcourse']);

Route::post('/addcourse', [CourseController::class, 'storecourse']);

Route::get('/subject', [SubjectController::class, 'subject']);

Route::get('/add_subject', [SubjectController::class, 'addsubject']);

Route::post('/addsubject', [SubjectController::class, 'storesubject']);

Route::post('/attendancefilter', [AttendanceController::class, 'attendance_filter']);

Route::post('/todayattendance', [AttendanceController::class, 'store']);

require __DIR__.'/auth.php';
