<?php

namespace Modules\ProductionReporting\Tests\Feature\Controllers\ProductionReportingController;

use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\get;

uses(\Tests\TestCase::class);

beforeEach(function () {
    $this->withoutExceptionHandling();
    Auth::loginUsingId(1);
});

it('should return correct component', function () {
    get('/production-reporting')
        ->hasModuleComponent('ProductionReporting', 'Index');
});

it('should pass correct props', function () {
    get('/production-reporting')
        ->hasResource('work_orders');
});
