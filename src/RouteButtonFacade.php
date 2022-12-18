<?php

namespace Wtfz\LaravelRouteButton;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wtfz\LaravelRouteButton\Skeleton\SkeletonClass
 */
class RouteButtonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'route-button';
    }
}