<?php

declare(strict_types=1);

namespace Modules\ProductionReporting;

use Illuminate\Support\Facades\Route;
use Modules\ProductionReporting\Http\Controllers\ProductionReportingController;

/*
|--------------------------------------------------------------------------
| Production Tracking
|--------------------------------------------------------------------------
*/

Route::get('/production-reporting', [ProductionReportingController::class, 'index'])
    ->name('production-reporting.index');

Route::post('/production-reporting', [ProductionReportingController::class, 'store'])
    ->name('production-reporting.store');
