<?php

namespace Biskoot\LaravelRouteButton;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Biskoot\LaravelRouteButton\Skeleton\SkeletonClass
 */
class LaravelRouteButtonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-route-button';
    }
}
