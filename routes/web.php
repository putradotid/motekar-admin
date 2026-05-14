<?php

use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\MeetingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\MeetingController as AdminMeetingController;
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
    Route::post('/meeting', [MeetingController::class, 'store'])->name('user-meeting.store');
    Route::delete('/meeting/{id}', [MeetingController::class, 'cancel'])->name('user-meeting.cancel');

    Route::get('/profile',  [ProfileController::class, 'index'])->name('user-profile');
    Route::put('/profile',  [ProfileController::class, 'update'])->name('user-profile.update');

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
    

    // Meeting routes
    Route::get('/meetings',                [AdminMeetingController::class, 'index'])->name('admin.meetings');
    Route::post('/meetings/{id}/approved',  [AdminMeetingController::class, 'approved'])->name('admin.meetings.approved');
    Route::post('/meetings/{id}/reject',   [AdminMeetingController::class, 'reject'])->name('admin.meetings.reject');
    Route::post('/meetings/{id}/done',     [AdminMeetingController::class, 'done'])->name('admin.meetings.done');

    // Manage user
    Route::get('/manage-user', [ManageUserController::class, 'userList'])->name('admin.manage.user');
    Route::get('/manage-admin', [ManageUserController::class, 'adminList'])->name('admin.manage.admin');
    Route::get('/create-admin', [ManageUserController::class, 'showCreate'])->name('admin.create');
    Route::post('/create-admin', [ManageUserController::class, 'store'])->name('admin.create.post');
    Route::post('/users/{id}/suspend', [ManageUserController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{id}/active', [ManageUserController::class, 'active'])->name('admin.users.active');
    
});