<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $router = $this->app->make('router');
        $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }

    public function boot()
    {
        //
    }
}
