<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\ProductionReporting\WebServices\WorkOrderWebService;

class WorkOrderController extends Controller
{
    public function show(string $workOrder): JsonResponse
    {
        $lines = WorkOrderWebService::get(
            site: auth()->user()->site,
            workOrder: $workOrder
        );

        return response()->json([
            'lines' => $lines,
            'success' => true,
        ], 200);
    }
}
