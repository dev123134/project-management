<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('freelancer', function (User $user) {
            return $user->role === 'freelancer';
        });

        Gate::define('client', function (User $user) {
            return $user->role === 'client';
        });

        Gate::define('employee', function (User $user) {
            return $user->role === 'employee';
        });

        View::composer('*', function ($view) {

            $count = 0;

            if (Auth::check()) {
                $count = Notification::where('user_id', Auth::id())
                    ->where('is_read', 0)
                    ->count();
            }

            $view->with('notificationCount', $count);
        });
    }
}
