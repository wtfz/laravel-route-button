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
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views', 'route-button');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views' => resource_path('views/vendor/route-button')
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
