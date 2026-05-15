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
use App\Models\Grievance;

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

Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/staff/register', function (Illuminate\Http\Request $request) {
    return view('staff-register'); 
})->name('staff.register.form')->middleware('signed');

Route::post('/staff/register', [AuthController::class, 'registerStaffSubmit'])->name('staff.register');

// ==========================================
// STUDENT ROUTES
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', function () {
        $grievances = Grievance::with(['student', 'comments.user'])
                               ->where('student_id', Auth::id())
                               ->latest()
                               ->get();
                               
        return view('student.dashboard', compact('grievances'));
    })->name('student.dashboard');

    Route::get('/student/grievance/new', [GrievanceController::class, 'create'])->name('grievance.create');
    Route::get('/grievance/{grievance}/evidence', [GrievanceController::class, 'downloadAttachment'])->name('grievance.attachment');
    Route::post('/student/grievance', [GrievanceController::class, 'store'])->name('grievance.store');
    Route::post('/grievance/{grievance}/comment', [GrievanceController::class, 'addComment'])->name('grievance.comment');
});

/// ==========================================
// AUTHORITY ROUTES
// ==========================================
Route::middleware(['auth'])->prefix('authority')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        $query = Grievance::with('student')->latest();

        if ($user->role === 'hod') {
            $query->where('category', '!=', 'Hostel')
                  ->whereHas('student', function ($q) use ($user) {
                      $q->where('department', $user->department);
                  });
        } elseif ($user->role === 'dean') {
            $query->where('category', '!=', 'Hostel')
                  ->whereHas('student', function ($q) use ($user) {
                      $q->where('school', $user->school);
                  });
        } elseif ($user->role === 'dsw_head') {
            $query->whereIn('category', ['Hostel', 'Harassment', 'Infrastructure']);
        }

        $pendingCount = (clone $query)->where('status', 'pending')->count();
        $inProgressCount = (clone $query)->where('status', 'in_progress')->count();
        $resolvedCount = (clone $query)->whereIn('status', ['resolved', 'closed'])->count();

        $grievances = $query->get(); 

        return view('authority.dashboard', compact('grievances', 'pendingCount', 'inProgressCount', 'resolvedCount'));
        
    })->name('authority.dashboard');

    Route::patch('/grievance/{grievance}/status', [GrievanceController::class, 'updateStatus'])->name('authority.grievance.update');
});

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/invite-staff', function () {
        return view('admin.invite-staff');
    })->name('admin.invite');

    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');

    Route::post('/invite-staff', function (Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $inviteUrl = URL::temporarySignedRoute(
            'staff.register.form', now()->addHours(48)
        );

        Mail::to($request->email)->send(new StaffInvitation($inviteUrl));

        return back()->with('success', 'Invitation successfully sent to ' . $request->email);
    })->name('admin.send_invite');

    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
});