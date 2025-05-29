<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});

Route::get('/benefits', function () {
    return view('benefits');
});

Route::get('/services', function () {
    return view('services'); // Replace with actual view file for Services
});

Route::get('/how', function () {
    return view('how'); // Replace with actual view file for How It Works
});

// Add any other pages like login, register, etc.
Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
