<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
<<<<<<< HEAD
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');
=======
});
>>>>>>> 2d809f1a9042a2f2d501e0cd1003d1165b1e6a41
