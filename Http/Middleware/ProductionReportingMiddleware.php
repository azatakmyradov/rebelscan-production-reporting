<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Http\Middleware;

use App\Http\Middleware\ModuleMiddleware;
use Illuminate\Http\Request;
use Modules\ProductionReporting\Providers\ProductionReportingServiceProvider;

class ProductionReportingMiddleware extends ModuleMiddleware
{
    /**
     * Module name
     *
     * This is used to register the module name in the app container
     */
    protected string $moduleName = 'ProductionReporting';

    /**
     * Routes that this module depends on
     */
    protected array $dependsOnRoutes = [
        'work-orders.show',
    ];

    /**
     * Service provider that provides the language files
     */
    public function languageProvider(): string
    {
        return ProductionReportingServiceProvider::class;
    }

    /**
     * Merge the language files
     */
    public function share(Request $request): array
    {
        return $this->mergeLanguageFiles($request, __DIR__);
    }
}
