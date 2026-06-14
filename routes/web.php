<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\MeetingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\MeetingController as AdminMeetingController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TentangKamiController;
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
Route::get('/hubungi-kami', function () {
    return view('public.contactpublik');
})->name('hubungi-kami');

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
    Route::get('/message',                [UserMessageController::class, 'index'])->name('user-message');
    Route::post('/message/{meetingId}',   [UserMessageController::class, 'store'])->name('user-message.store');
    
    Route::get('/request-meeting', function () {
        return view('user.requestMeeting');
    })->name('request-meeting');

});

// Halaman Admin
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // website management — Homepage
    Route::get('/homepage', [HomePageController::class, 'index'])->name('admin.homepage');

    // Hero
    Route::post('/homepage/hero',           [HomePageController::class, 'storeHero'])->name('admin.homepage.hero.store');
    Route::put('/homepage/hero/{id}',       [HomePageController::class, 'updateHero'])->name('admin.homepage.hero.update');
    Route::delete('/homepage/hero/{id}',    [HomePageController::class, 'destroyHero'])->name('admin.homepage.hero.destroy');

    // About
    Route::post('/homepage/about',          [HomePageController::class, 'storeAbout'])->name('admin.homepage.about.store');
    Route::put('/homepage/about/{id}',      [HomePageController::class, 'updateAbout'])->name('admin.homepage.about.update');

    // Stats
    Route::post('/homepage/stats',          [HomePageController::class, 'storeStats'])->name('admin.homepage.stats.store');
    Route::put('/homepage/stats/{id}',      [HomePageController::class, 'updateStats'])->name('admin.homepage.stats.update');

    // Services
    Route::post('/homepage/services',       [HomePageController::class, 'storeService'])->name('admin.homepage.services.store');
    Route::put('/homepage/services/{id}',   [HomePageController::class, 'updateService'])->name('admin.homepage.services.update');
    Route::delete('/homepage/services/{id}',[HomePageController::class, 'destroyService'])->name('admin.homepage.services.destroy');

    // CTA
    Route::post('/homepage/cta',            [HomePageController::class, 'storeCta'])->name('admin.homepage.cta.store');
    Route::put('/homepage/cta/{id}',        [HomePageController::class, 'updateCta'])->name('admin.homepage.cta.update');
    

    // Tentang Kami
    Route::get('/tentang-kami',  [TentangKamiController::class, 'index'])->name('admin.tentang-kami');
    Route::post('/tentang-kami', [TentangKamiController::class, 'store'])->name('admin.tentang-kami.store');
    Route::put('/tentang-kami/{id}', [TentangKamiController::class, 'update'])->name('admin.tentang-kami.update');


    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('admin.calendar.events');
    
    // Meeting routes
    Route::get('/meetings', [AdminMeetingController::class, 'index'])->name('admin.meetings');
    Route::get('/meetings/{id}', [AdminMeetingController::class, 'show'])->name('admin.meetings.show');
    Route::post('/meetings/{id}/approved', [AdminMeetingController::class, 'approved'])->name('admin.meetings.approved');
    Route::post('/meetings/{id}/reject', [AdminMeetingController::class, 'reject'])->name('admin.meetings.reject');
    Route::post('/meetings/{id}/done', [AdminMeetingController::class, 'done'])->name('admin.meetings.done');

    // Manage user
    Route::get('/manage-user', [ManageUserController::class, 'userList'])->name('admin.manage.user');
    Route::get('/manage-admin', [ManageUserController::class, 'adminList'])->name('admin.manage.admin');
    Route::get('/create-admin', [ManageUserController::class, 'showCreate'])->name('admin.create');
    Route::post('/create-admin', [ManageUserController::class, 'store'])->name('admin.create.post');
    Route::post('/users/{id}/suspend', [ManageUserController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{id}/active', [ManageUserController::class, 'active'])->name('admin.users.active');
    
    // Message
    Route::get('/messages',[AdminMessageController::class, 'index'])->name('admin.messages');
    Route::post('/messages/{meetingId}', [AdminMessageController::class, 'store'])->name('admin.messages.store');

    // Media
    Route::get('/media', [MediaController::class, 'index'])->name('admin.media');
    Route::post('/media', [MediaController::class, 'store'])->name('admin.media.store');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');

    // Setting
    Route::get('/setting',  [AdminSettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting', [AdminSettingController::class, 'update'])->name('admin.setting.update');

    // Activity Log
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs');

    // Contact public
    Route::get('/contacts',              [AdminContactController::class, 'index'])->name('admin.contacts');
    Route::get('/contacts/{id}',         [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::post('/contacts/{id}/status', [AdminContactController::class, 'updateStatus'])->name('admin.contacts.status');
    Route::delete('/contacts/{id}',      [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
});