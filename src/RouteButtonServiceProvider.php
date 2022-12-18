<?php

namespace Wtfz\LaravelRouteButton;

use Illuminate\Support\ServiceProvider;

class RouteButtonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'views', 'route-button');

        $this->publishes([
            __DIR__.DIRECTORY_SEPARATOR.'views' => base_path('resources/views/vendor/route-button')
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
