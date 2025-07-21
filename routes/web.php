<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    if (!session('logged_in')) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard'); // ✅ added route name

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Teacher routes
Route::resource('teachers', TeacherController::class);


//Academic session route
Route::post('/academic-sessions/store', [AcademicSessionController::class, 'store'])->name('academic_sessions.store');
Route::post('/academic-sessions/{id}/activate', [AcademicSessionController::class, 'activate'])->name('academic_sessions.activate');

//students
Route::resource('students', StudentController::class);

Route::resource('students', StudentController::class)->only(['create', 'store']);
