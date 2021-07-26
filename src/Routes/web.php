<?php

$api_route_prefix = config('badaso-POS.prefix');

Route::group(
    [
        'prefix' => $api_route_prefix,
        'namespace' => 'Uasoft\Badaso\Module\POS\Controllers',
        'as' => 'badaso.module.POS.',
        'middleware' => 'web',
    ],
    function () {
    }
);
