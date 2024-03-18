<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Modules\General\WebServices\WorkOrderWebService;
use Modules\ProductionReporting\DTO\ProductionReportingDTO;
use Modules\ProductionReporting\WebServices\ProductionReportingWebService;

class ProductionReportingController extends Controller
{
    public function index(WorkOrderWebService $webService): Response
    {
        $work_orders = $webService->all(auth()->user()->site);

        return render('Index', [
            'work_orders' => $work_orders,
        ]);
    }

    public function store(Request $request, ProductionReportingWebService $productionTrackingWebService): void
    {
        $attributes = $request->validate([
            'MFGNUM' => ['required'],
            'UOM' => ['required'],
            'QTY' => ['required'],
            'MVTDES' => ['nullable'],
            'ITMREF' => ['required'],
            'LOT' => ['nullable'],
            'SLO' => ['nullable'],
            'SERNUM' => ['nullable'],
            'PALNUM' => ['nullable'],
        ]);

        $attributes = ProductionReportingDTO::fromArray($attributes);

        $productionTrackingWebService->submit(
            site: auth()->user()->site,
            attributes: $attributes->toArray('I_')
        );

        back()
            ->with([
                'message' => 'Production Reporting submitted',
            ]);
    }
}
