<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrievanceController;
use App\Models\Grievance;

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
        $grievances = Grievance::where('student_id', Auth::id())->latest()->get();
        return view('student.dashboard', compact('grievances'));
    })->name('student.dashboard');

    Route::get('/student/grievance/new', [GrievanceController::class, 'create'])->name('grievance.create');
    Route::post('/student/grievance', [GrievanceController::class, 'store'])->name('grievance.store');

    Route::get('/staff/register', function () {
        return view('staff.register');
    })->name('staff.register.form');
    Route::post('/staff/register', [AuthController::class, 'registerStaffSubmit'])->name('staff.register');
});

Route::middleware(['auth'])->prefix('authority')->group(function () {
    Route::get('/dashboard', function () {
        $grievances = Grievance::latest()->get();
        return view('authority.dashboard');
    })->name('authority.dashboard');

    Route::patch('/grievance/{grievance}/status', [GrievanceController::class, 'updateStatus'])->name('authority.grievance.update');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});