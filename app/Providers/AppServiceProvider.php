<?php
 
namespace App\Providers;
 
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
 
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
        // Str macros to clean rich text HTML entities (like &nbsp;) for excerpts
        Str::macro('cleanText', function ($value) {
            $cleaned = html_entity_decode(strip_tags($value), ENT_QUOTES, 'UTF-8');
            return trim(preg_replace('/\s+/u', ' ', $cleaned));
        });

        Str::macro('cleanExcerpt', function ($value, $limit = 100, $end = '...') {
            return Str::limit(Str::cleanText($value), $limit, $end);
        });

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
