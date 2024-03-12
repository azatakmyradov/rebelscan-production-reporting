<?php

declare(strict_types=1);

namespace Modules\ProductionTracking\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\ProductionTracking\Http\Middleware\ProductionTrackingMiddleware;

class RouteServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware(['web', 'auth', 'soap', ProductionTrackingMiddleware::class])
                ->group(__DIR__.'/../routes.php');
        });
    }
}
