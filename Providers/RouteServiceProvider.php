<?php

namespace Modules\ProductionTracking\Providers;

use Illuminate\Support\Facades\Route;
use Modules\ProductionTracking\Http\Middleware\ProductionTrackingMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;

class RouteServiceProvider extends BaseServiceProvider {
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware(['web', 'auth', 'soap', ProductionTrackingMiddleware::class])
                ->group(__DIR__ . '/../routes.php');
        });
    }
}


