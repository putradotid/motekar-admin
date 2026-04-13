<?php

use Illuminate\Support\Facades\Route;

// Halaman Public
Route::get('/', function () {
    return view('public.beranda');
});
Route::get('/tentang-kami', function () {
    return view('public.tentangkami');
});
Route::get('/produk-layanan', function () {
    return view('public.productlayanan');
});
Route::get('/kontak', function () {
    return view('public.kontak');
});
Route::get('/testimoni', function () {
    return view('public.testimoni');
});
Route::get('/tim-kami', function () {
    return view('public.timkami');
});

// Halaman Auth
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Halaman User
Route::prefix('user')->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/meeting', function () {
        return view('user.meeting.index');
    });

    Route::get('/profile', function () {
        return view('user.profile');
    });

    Route::get('/message', function () {
        return view('user.message');
    });

});

// Halaman Admin
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

});