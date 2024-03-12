<?php

declare(strict_types=1);

namespace Modules\ProductionTracking\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Modules\ProductionTracking\WebServices\WorkOrderWebService;

class ProductionTrackingController extends Controller
{
    public function index(): Response
    {
        $work_orders = WorkOrderWebService::get(auth()->user()->site);

        return render('Index', [
            'work_orders' => $work_orders,
        ]);
    }
}
