<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/auth', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

