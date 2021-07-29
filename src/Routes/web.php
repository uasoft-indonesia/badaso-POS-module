<?php

Route::group(
    [
        'prefix' => '/pos',
        'namespace' => 'Uasoft\Badaso\Module\POS\Controllers',
        'as' => 'badaso.module.pos.',
        'middleware' => ['web'],
    ],
    function () {
        Route::get('/{any?}', 'POSController@index')
            ->where('any', '.*')
            ->name('index');
    }
);
