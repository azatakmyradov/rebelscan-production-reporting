<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Providers;

use App\Providers\BaseServiceProvider;

class ProductionReportingServiceProvider extends BaseServiceProvider
{
    /**
     * The path to the module
     */
    protected string $module_path = __DIR__;

    /**
     * The home links for the module
     */
    protected array $home_links = [
        [
            'name' => 'Production Reporting',
            'route' => 'production-reporting.index',
            'can' => 'use production-reporting',
        ]
    ];

    /**
     * The permissions for the module
     */
    protected array $permissions = [
        'use production-reporting',
    ];

    /**
     * The route provider for the module
     */
    public function routeProvider(): string
    {
        return RouteServiceProvider::class;
    }
}
