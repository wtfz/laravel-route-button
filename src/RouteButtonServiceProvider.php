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
        $this->loadViewsFrom(__DIR__.'/../views', 'route-button');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../views' => resource_path('views/vendor/route-button')
            ], 'views');
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
