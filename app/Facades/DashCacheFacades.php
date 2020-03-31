<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ThrowNewExceptionFacades
 * @package App\Facades
 */
class DashCacheFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\MyClass\DashCache';
    }
}
