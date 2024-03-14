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
     * Handle the middleware
     */
    public function handle(Request $request, $next): mixed
    {
        // [Load translations]
        $provider = app()->resolveProvider(ProductionReportingServiceProvider::class);
        $provider->loadTranslations();

        // [Register app name]
        app()->bind('module', fn () => $this->moduleName);

        return parent::handle($request, $next);
    }

    public function share(Request $request): array
    {
        return $this->mergeLanguageFiles($request, __DIR__);
    }
}
