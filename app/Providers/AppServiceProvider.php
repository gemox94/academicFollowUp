<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $coordinator = false;
        $user        = User::where('role_id', 1)->get();

        if($user->count() > 1){
            $coordinator = true;
        }

        view()->composer('layouts.app', function($view) use($coordinator)
        {
            $view->with('coordinator', $coordinator);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
