<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.login', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $followingsCount = $user->followings()->count();
                $followersCount = $user->followers()->count();

                $view->with(compact('followingsCount', 'followersCount'));
            }
        });
    }
}
