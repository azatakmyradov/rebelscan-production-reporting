<?php

namespace Modules\ProductionReporting\Tests\Feature\Controllers\ProductionReportingController;

use Illuminate\Support\Facades\Auth;
use Mockery;
use Modules\ProductionReporting\WebServices\WorkOrderWebService;
use function Pest\Laravel\get;

uses(\Tests\TestCase::class);

beforeEach(function () {
    $this->withoutExceptionHandling();
    Auth::loginUsingId(1);

    Mockery::mock('overload:' . WorkOrderWebService::class)
        ->makePartial()
        ->expects()
        ->all('NA023')
        ->andReturn(collect([
            [
                'MFGNUM' => '123',
            ],
        ]));
});

it('should return correct component', function () {
    get('/production-reporting')
        ->hasComponent('ProductionReporting/resources/views/Index')
        ->hasResource('work_orders', [
            [
                'MFGNUM' => '123',
            ]
        ]);
});

it('should pass correct props', function () {
    get('/production-reporting')
        ->hasResource('work_orders', [
            [
                'MFGNUM' => '123',
            ]
        ]);
});
