<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\WebServices;

use App\Utils\WebService;

class ProductionReportingWebService
{
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
