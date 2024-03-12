<?php

declare(strict_types=1);

namespace Modules\ProductionTracking\Http\Middleware;

use App\Http\Middleware\ModuleMiddleware;
use Illuminate\Http\Request;
use Modules\ProductionTracking\Providers\ProductionTrackingServiceProvider;

class ProductionTrackingMiddleware extends ModuleMiddleware
{
    /**
     * Module name
     *
     * This is used to register the module name in the app container
     */
    protected string $moduleName = 'ProductionTracking';

    /**
     * Handle the middleware
     */
    public function handle(Request $request, $next): mixed
    {
        // [Load translations]
        $provider = app()->resolveProvider(ProductionTrackingServiceProvider::class);
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
