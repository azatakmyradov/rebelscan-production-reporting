<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Modules\ProductionReporting\DTO\ProductionReportingDTO;
use Modules\ProductionReporting\WebServices\WorkOrderWebService;

class ProductionReportingController extends Controller
{
    public function index(): Response
    {
        $work_orders = WorkOrderWebService::all(auth()->user()->site);

        return render('Index', [
            'work_orders' => $work_orders,
        ]);
    }

    public function store(Request $request)
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

        WorkOrderWebService::submit(
            site: auth()->user()->site,
            attributes: $attributes->toArray('I_')
        );

        back()
            ->with([
                'message' => 'Production Reporting submitted'
            ]);
    }
}
