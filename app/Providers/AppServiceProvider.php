<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $router = $this->app->make('router');
        $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
        $router->aliasMiddleware('auth:sanctum', \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);

    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

       require base_path('routes/channels.php');



    }
}
