<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\WebServices;

use App\Utils\WebService;
use Illuminate\Support\Collection;
use Modules\ProductionReporting\DTO\WorkOrderDTO;
use Modules\ProductionReporting\DTO\WorkOrderLineDTO;

class WorkOrderWebService
{
    /*
     * @return Collection<WorkOrderDTO>
     */
    public function all(string $site): Collection
    {
        $response = WebService::new()
            ->withParams([
                'I_FCY' => $site,
            ])
            ->run('XX3DWLSMFG');

        return collect($response['PARAM_OUT'] ?? [])->map(function (array $workOrder) {
            return WorkOrderDTO::fromArray($workOrder, 'O_');
        });
    }

    /*
    * @return Collection<WorkOrderLineDTO>
    */
    public static function get(string $site, string $workOrder): Collection
    {
        $response = WebService::new()
            ->withParams([
                'I_FCY' => $site,
                'I_MFGNUM' => $workOrder,
            ])
            ->run('XX3DWREMFG');

        return collect($response['PARAM_OUT'] ?? [])->map(function (array $workOrder) {
            return WorkOrderLineDTO::fromArray($workOrder, 'O_');
        });
    }

    public static function submit(string $site, array $attributes): void
    {
        WebService::new()
            ->withParams([
                ...$attributes,
                'I_FCY' => $site,
                'I_MFGTRKDAT' => now()->format('Ymd'),
            ])
            ->run('XX3DWEXMTK');
    }
}
