<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Tests\Feature\Controllers\ProductionReportingController;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(\Tests\TestCase::class);

it('should return correct component', function () {
    actingAs(createAdmin());

    fakeHttp([
        'PARAM_OUT' => [],
        'PARAM_STAT' => [
            'O_STAT' => 1,
            'O_MESSAGE' => '',
        ]
    ]);

    get('/production-reporting')
        ->hasModuleComponent('ProductionReporting', 'Index');
});

it('should pass correct props', function () {
    actingAs(createAdmin());

    fakeHttp([
        'PARAM_OUT' => [],
        'PARAM_STAT' => [
            'O_STAT' => 1,
            'O_MESSAGE' => '',
        ]
    ]);

    get('/production-reporting')
        ->hasResource('work_orders');
});
