<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\MeetingController;
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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Halaman User
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/meeting', [MeetingController::class, 'index'])->name('user-meeting');
    Route::delete('/meeting/{id}', [MeetingController::class, 'cancel'])->name('user-meeting.cancel');

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
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/create-admin', function () {
        return view('auth.registerAdmin');
    })->name('admin.create');

});