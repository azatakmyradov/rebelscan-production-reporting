<?php

declare(strict_types=1);

namespace Modules\ProductionTracking\WebServices;

use App\Utils\WebService;
use Illuminate\Support\Collection;

class WorkOrderWebService
{
    public static function get(string $site): Collection
    {
        $response = WebService::new()
            ->withParams([
                'I_FCY' => $site,
            ])
            ->run('XX3DWLSMFG');

        return collect($response['PARAM_OUT'] ?? []);
    }
}
