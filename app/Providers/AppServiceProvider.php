<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
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
        View::composer('components.dashboard.topbar', function ($view) {
            $notifications = collect();
            $unreadNotificationCount = 0;

            if (auth()->check()) {
                $notifications = Notification::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();

                $unreadNotificationCount = Notification::where('user_id', auth()->id())
                    ->unread()
                    ->count();
            }

            $view->with(compact('notifications', 'unreadNotificationCount'));
        });
    }
}
