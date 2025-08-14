<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth:sanctum', 'verified', 'role:admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth:sanctum', 'verified', 'role:client'])
                ->prefix('portal')
                ->name('portal.')
                ->group(base_path('routes/portal.php'));

            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));
        });
    }
}

