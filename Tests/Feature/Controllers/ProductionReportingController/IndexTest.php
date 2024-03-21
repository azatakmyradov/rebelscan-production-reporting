<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Tests\Feature\Controllers\ProductionReportingController;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

uses(\Tests\TestCase::class);

beforeEach(function () {
    seed('DatabaseSeeder');
});

it('should return correct component', function () {
    actingAs(createAdmin());

    fakeHttpResponse();

    get('/production-reporting')
        ->hasModuleComponent('ProductionReporting', 'Index');
});

it('should pass correct props', function () {
    actingAs(createAdmin());

    fakeHttpResponse();

    get('/production-reporting')
        ->hasResource('work_orders');
});
