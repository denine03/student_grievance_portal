<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Import the controller

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register.form'); // Renamed slightly to avoid conflict with the POST route

// --- The New Form Submission Route ---
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register');