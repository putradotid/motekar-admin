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
            if (session('token') && session('user.role') === 'admin') {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(5)
                        ->withToken(session('token'))
                        ->get(config('api.url') . '/admin/notifications/count');

                    $notif = $response->successful() ? $response->json() : [];
                } catch (\Exception $e) {
                    $notif = [];
                }

                $view->with('notif', $notif);
            }
        });
    }
}
