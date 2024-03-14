<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\ProductionReporting\Http\Middleware\ProductionReportingMiddleware;

class RouteServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware(['web', 'auth', 'soap', ProductionReportingMiddleware::class])
                ->group(__DIR__ . '/../routes.php');
        });
    }
}
