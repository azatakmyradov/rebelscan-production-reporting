<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\ProductionTracking\Http\Controllers\ProductionTrackingController;

Route::get('/production-tracking', [ProductionTrackingController::class, 'index']);
