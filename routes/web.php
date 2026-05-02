<?php

use Illuminate\Support\Facades\Route;

// Halaman Public
Route::get('/', function () {
    return view('public.beranda');
})->name('beranda');
Route::get('/tentang-kami', function () {
    return view('public.tentangkami');
})->name('tentang-kami');
Route::get('/produk-layanan', function () {
    return view('public.productlayanan');
})->name('produk-layanan');
Route::get('/kontak', function () {
    return view('public.kontak');
})->name('kontak')  ;
Route::get('/testimoni', function () {
    return view('public.testimoni');
})->name('testimoni');
Route::get('/tim-kami', function () {
    return view('public.timkami');
})->name('tim-kami');

// Halaman Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Halaman User
Route::prefix('user')->group(function () {
    Route::get('/meeting', function () {
        return view('user.meeting');
    })->name('user-meeting');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user-profile');

    Route::get('/message', function () {
        return view('user.message');
    })->name('user-message');
    
    Route::get('/request-meeting', function () {
        return view('user.requestMeeting');
    })->name('request-meeting');

});

// Halaman Admin
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/create-admin', function () {
        return view('auth.registerAdmin');
    })->name('admin.create');

});