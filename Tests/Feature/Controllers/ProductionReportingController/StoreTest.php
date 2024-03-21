<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\Tests\Feature\Controllers\ProductionReportingController;

use function Pest\Laravel\post;
use function Pest\Laravel\seed;

uses(\Tests\TestCase::class);

beforeEach(function () {
    seed('DatabaseSeeder');
});

it('requires authentication', function () {
    post(route('production-reporting.index'))
        ->assertRedirectToRoute('login');
});

it('validates required props', function (array $data) {
    loginAsAdmin();

    fakeHttpResponse();
    post(route('production-reporting.store'), $data)->assertSessionHasErrors(array_keys($data));
})->with([
    [
        [
            'MFGNUM' => '',
            'UOM' => '',
            'QTY' => '',
            'ITMREF' => '',
        ],
        [
            'MFGNUM' => '123',
            'UOM' => '123',
            'QTY' => '123',
            'ITMREF' => '123',
        ]
    ]
]);

it('redirects back after submitting', function (array $data) {
    loginAsAdmin();

    fakeHttpResponse();
    post(route('production-reporting.store'), $data)
        ->assertSessionHasNoErrors()
        ->assertRedirectToRoute('home')
        ->assertSessionHas('message', 'Production Reporting submitted');
})->with([
    [
        [
            'MFGNUM' => 'valid',
            'UOM' => 'valid',
            'QTY' => 'valid',
            'ITMREF' => 'valid',
            'MVTDES' => '',
            'LOT' => '',
            'SLO' => '',
            'SERNUM' => '',
            'PALNUM' => '',
        ],
    ]
]);
