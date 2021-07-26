<?php

namespace Uasoft\Badaso\Module\POS\Facades;

use Illuminate\Support\Facades\Facade;

class BadasoPOSModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'badaso-POS-module';
    }
}
