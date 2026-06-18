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
use App\Http\Controllers\Admin\ProdukLayananController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\TimKamiController;
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

    // Produk & Layanan
    Route::get('/produk-layanan', [ProdukLayananController::class, 'index'])->name('admin.produk-layanan');
    // Hero
    Route::post('/produk-layanan/hero', [ProdukLayananController::class, 'storeHero'])->name('admin.produk-layanan.hero.store');
    Route::put('/produk-layanan/hero/{id}', [ProdukLayananController::class, 'updateHero'])->name('admin.produk-layanan.hero.update');
    // Products
    Route::post('/produk-layanan/products', [ProdukLayananController::class, 'storeProduct'])->name('admin.produk-layanan.products.store');
    Route::put('/produk-layanan/products/{id}', [ProdukLayananController::class, 'updateProduct'])->name('admin.produk-layanan.products.update');
    Route::delete('/produk-layanan/products/{id}', [ProdukLayananController::class, 'destroyProduct'])->name('admin.produk-layanan.products.destroy');
    // Services
    Route::post('/produk-layanan/services', [ProdukLayananController::class, 'storeService'])->name('admin.produk-layanan.services.store');
    Route::put('/produk-layanan/services/{id}', [ProdukLayananController::class, 'updateService'])->name('admin.produk-layanan.services.update');
    Route::delete('/produk-layanan/services/{id}', [ProdukLayananController::class, 'destroyService'])->name('admin.produk-layanan.services.destroy');

    // Testimoni
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni');
    // Hero
    Route::post('/testimoni/hero', [TestimoniController::class, 'storeHero'])->name('admin.testimoni.hero.store');
    Route::put('/testimoni/hero/{id}', [TestimoniController::class, 'updateHero'])->name('admin.testimoni.hero.update');
    // Featured Customers
    Route::post('/testimoni/featured-customers', [TestimoniController::class, 'storeFeaturedCustomer'])->name('admin.testimoni.featured.store');
    Route::put('/testimoni/featured-customers/{id}', [TestimoniController::class, 'updateFeaturedCustomer'])->name('admin.testimoni.featured.update');
    Route::delete('/testimoni/featured-customers/{id}', [TestimoniController::class, 'destroyFeaturedCustomer'])->name('admin.testimoni.featured.destroy');
    // Testimonials
    Route::post('/testimoni/testimonials', [TestimoniController::class, 'storeTestimonial'])->name('admin.testimoni.testimonials.store');
    Route::put('/testimoni/testimonials/{id}', [TestimoniController::class, 'updateTestimonial'])->name('admin.testimoni.testimonials.update');
    Route::delete('/testimoni/testimonials/{id}', [TestimoniController::class, 'destroyTestimonial'])->name('admin.testimoni.testimonials.destroy');
    // Client & Partners
    Route::post('/testimoni/partners', [TestimoniController::class, 'storePartner'])->name('admin.testimoni.partners.store');
    Route::put('/testimoni/partners/{id}', [TestimoniController::class, 'updatePartner'])->name('admin.testimoni.partners.update');
    Route::delete('/testimoni/partners/{id}', [TestimoniController::class, 'destroyPartner'])->name('admin.testimoni.partners.destroy');

    // Tim Kami
    Route::get('/tim-kami',  [TimKamiController::class, 'index'])->name('admin.tim-kami');
    // Hero
    Route::post('/tim-kami/hero',     [TimKamiController::class, 'storeHero'])->name('admin.tim-kami.hero.store');
    Route::put('/tim-kami/hero/{id}', [TimKamiController::class, 'updateHero'])->name('admin.tim-kami.hero.update');
    // Members
    Route::post('/tim-kami/members',        [TimKamiController::class, 'storeMember'])->name('admin.tim-kami.members.store');
    Route::put('/tim-kami/members/{id}',    [TimKamiController::class, 'updateMember'])->name('admin.tim-kami.members.update');
    Route::delete('/tim-kami/members/{id}', [TimKamiController::class, 'destroyMember'])->name('admin.tim-kami.members.destroy');

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