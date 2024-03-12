<?php

namespace Modules\ProductionTracking\Providers;

use App\Providers\BaseServiceProvider;

class ProductionTrackingServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');

        $this->app->register(RouteServiceProvider::class);
    }


    /**
     * Load the translations
     */
    public function loadTranslations(): void
    {
        $this->loadJsonTranslationsFrom(__DIR__ . '/../lang');
    }
}

