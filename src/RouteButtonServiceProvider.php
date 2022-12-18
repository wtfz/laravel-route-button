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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'route-button');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/route-button')
            ], 'laravel-route-button');
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
