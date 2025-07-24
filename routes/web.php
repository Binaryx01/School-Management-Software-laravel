<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SectionController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Login and Logout
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    if (!session('logged_in')) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard');

// Teachers CRUD
Route::resource('teachers', TeacherController::class);

// Academic Sessions
Route::resource('academic_sessions', AcademicSessionController::class);
Route::post('/academic-sessions/{id}/activate', [AcademicSessionController::class, 'activate'])->name('academic_sessions.activate');

// Students CRUD (only define once)
Route::resource('students', StudentController::class);

// Classes routes
Route::get('/classes', [SchoolClassController::class, 'index'])->name('classes.index');
Route::post('/classes', [SchoolClassController::class, 'store'])->name('classes.store');

// Sections (edit/update/delete)
Route::prefix('sections')->name('sections.')->group(function () {
    Route::get('{section}/edit', [SectionController::class, 'edit'])->name('edit');
    Route::put('{section}', [SectionController::class, 'update'])->name('update');
    Route::delete('{section}', [SectionController::class, 'destroy'])->name('destroy');
});


Route::resource('sections', SectionController::class)->only(['store', 'edit', 'update', 'destroy']);
Route::resource('classes', \App\Http\Controllers\SchoolClassController::class);


