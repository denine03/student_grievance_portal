<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrievanceController;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

Route::middleware(['auth'])->group(function () {
    // The Dashboard (You already have this)
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    // --- The New Grievance Routes ---
    Route::get('/student/grievance/new', [GrievanceController::class, 'create'])->name('grievance.create');
    Route::post('/student/grievance', [GrievanceController::class, 'store'])->name('grievance.store');
});