<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Providers;

use App\Providers\BaseServiceProvider;

class ProductionReportingServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');

        $this->app->register(RouteServiceProvider::class);

        $this->addHomeLink(
            can: 'use production-reporting',
            name: 'Production Reporting',
            route: 'production-reporting.index',
        );

        $this->addPermission('use production-reporting');
    }

    /**
     * Load the translations
     */
    public function loadTranslations(): void
    {
        $this->loadJsonTranslationsFrom(__DIR__ . '/../lang');
    }
}
