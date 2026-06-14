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

        // Homepage data untuk public pages
        view()->composer(['layouts.public', 'public.*'], function ($view) {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get(config('api.url') . '/homepage');
                
                $homepageData = $response->successful() ? ($response->json() ?? []) : [];
            } catch (\Exception $e) {
                $homepageData = [];
            }

            $view->with('heroSlides', $homepageData['hero'] ?? [])
                ->with('about', $homepageData['about'])
                ->with('stats', $homepageData['stats'])
                ->with('services', $homepageData['services'] ?? [])
                ->with('cta', $homepageData['cta']);
        });

        // Tentang Kami data untuk halaman public tentang kami
        view()->composer('public.tentangkami', function ($view) {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get(config('api.url') . '/tentang-kami-page');
                $aboutUs = $response->successful() ? $response->json() : null;
            } catch (\Exception $e) {
                $aboutUs = null;
            }
            $view->with('aboutUs', $aboutUs);
        });
    }
}
