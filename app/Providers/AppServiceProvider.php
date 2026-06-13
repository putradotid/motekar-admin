<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Admin topbar
        view()->composer('components.admin.topbar', function ($view) {
            $notif = [
                'pending_meetings' => 0,
                'unread_messages'  => 0,
                'latest_unread'    => [],
                'meetings_today'   => 0,
            ];
            if (session('token') && session('user.role') === 'admin') {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(5)
                        ->withToken(session('token'))
                        ->get(config('api.url') . '/admin/notifications/count');
                    if ($response->successful()) {
                        $notif = array_merge($notif, $response->json() ?? []);
                    }
                } catch (\Exception $e) {}
            }
            $view->with('notif', $notif);
        });

        // Public pages — gabung setting + heroSlides dalam 1 composer
        view()->composer(['layouts.public', 'public.*'], function ($view) {
            // Setting
            try {
                $setting = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get(config('api.url') . '/settings')
                    ->json() ?? [];
            } catch (\Exception $e) {
                $setting = [];
            }

            // Hero Slides
            try {
                $heroSlides = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get(config('api.url') . '/hero-slides')
                    ->json() ?? [];
            } catch (\Exception $e) {
                $heroSlides = [];
            }

            $view->with('setting', $setting);
            $view->with('heroSlides', $heroSlides);
        });
    }
}
