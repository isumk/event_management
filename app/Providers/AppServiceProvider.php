<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $router = $this->app->make('router');
        $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
