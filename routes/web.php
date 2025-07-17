<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('dashboard'); // create this view if needed
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');