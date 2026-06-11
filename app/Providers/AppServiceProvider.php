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
        // share notif ke semua view admin
        view()->composer('components.admin.topbar', function ($view) {
            $notif = [
                'pending_meetings'  => 0,
                'unread_messages'   => 0,
                'latest_unread'     => [],
                'meetings_today'    => 0,
            ];
            if (session('token') && session('user.role') === 'admin') {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(5)
                        ->withToken(session('token'))
                        ->get(config('api.url') . '/admin/notifications/count');

                    if ($response->successful()) {
                        $notif = array_merge($notif, $response->json() ?? []);
                    }
                } catch (\Exception $e) {
                    $notif = [];
                }

                $view->with('notif', $notif);
            }
        });

        // Setting untuk semua public pages
        view()->composer(['layouts.public', 'public.*' ], function ($view) {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get(config('api.url') . '/settings');

                $setting = $response->successful() ? $response->json() : [];
            } catch (\Exception $e) {
                $setting = [];
            }

            $view->with('setting', $setting);
        });
    }
}
