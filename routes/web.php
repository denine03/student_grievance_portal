<?php

use App\Mail\StaffInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrievanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorityController;
use App\Models\Grievance;
use App\Http\Controllers\PasswordResetController;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::get('/staff/register', function (Illuminate\Http\Request $request) {
    return view('staff-register'); 
})->name('staff.register.form')->middleware('signed');

Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/staff/register', [AuthController::class, 'registerStaffSubmit'])->name('staff.register');
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');

// ==========================================
// STUDENT ROUTES
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [GrievanceController::class, 'index'])->name('student.dashboard');
    Route::get('/student/grievance/new', [GrievanceController::class, 'create'])->name('grievance.create');
    Route::get('/grievance/{grievance}/evidence', [GrievanceController::class, 'downloadAttachment'])->name('grievance.attachment');
    Route::post('/student/grievance', [GrievanceController::class, 'store'])->name('grievance.store');
    Route::post('/grievance/{grievance}/comment', [GrievanceController::class, 'addComment'])->name('grievance.comment');
});

/// ==========================================
// AUTHORITY ROUTES
// ==========================================
Route::middleware(['auth'])->prefix('authority')->group(function () {
    Route::get('/dashboard', [AuthorityController::class, 'dashboard'])->name('authority.dashboard');
    Route::patch('/grievance/{grievance}/status', [AuthorityController::class, 'updateStatus'])->name('authority.grievance.update');
    Route::post('/grievance/{grievance}/comment', [AuthorityController::class, 'addComment'])->name('authority.comment');
});

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/grievances', [AdminController::class, 'grievances'])->name('admin.grievances');
    Route::patch('/grievances/{grievance}/status', [AdminController::class, 'updateGrievanceStatus'])->name('admin.grievances.update');
    Route::delete('/grievances/{grievance}', [AdminController::class, 'deleteGrievance'])->name('admin.grievances.destroy');

    Route::get('/invite-staff', function () {
        return view('admin.invite-staff');
    })->name('admin.invite');

    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');

    Route::post('/invite-staff', function (Illuminate\Http\Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $inviteUrl = Illuminate\Support\Facades\URL::temporarySignedRoute(
            'staff.register.form', now()->addHours(48)
        );

        Illuminate\Support\Facades\Mail::to($request->email)->send(new App\Mail\StaffInvitation($inviteUrl));

        return back()->with('success', 'Invitation successfully sent to ' . $request->email);
    })->name('admin.send_invite');

    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
});