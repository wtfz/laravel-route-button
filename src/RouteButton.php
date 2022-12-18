<?php

namespace Wtfz\LaravelRouteButton;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * Trait RouteButton.
 */
trait RouteButton
{
    /**
     * Current attached model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new child relationship instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = $this;
    }

    /**
     * Get model name in snake case format
     *
     * @return string
     */
    public function getRouteButtonNameAttribute()
    {
        return Str::snake( class_basename( get_class( $this->model ) ) );
    }

    /**
     * Get model name with id as a key
     *
     * @return string
     */
    public function getRouteButtonKeyAttribute()
    {
        return $this->route_button_name .'_'. $this->model->id;
    }

    /**
     * Get model name with id as a key
     *
     * @return array
     */
    public function getRouteButtonDataAttribute()
    {
        $routes = [];

        if( count(static::$routeButton) > 0 ){
            foreach( static::$routeButton as $route ) {
                $methods = Route::getRoutes()->getByName($route['route'])->methods();
                $methods = is_array($methods) ? $methods : [$methods];

                if( in_array( 'DELETE', $methods ) ) {
                    $route['method'] = 'delete';
                    $route['form'] = 'delete';
                } elseif( in_array( 'PATCH', $methods ) ) {
                    $route['method'] = 'patch';
                    $route['form'] = 'confirm';
                } elseif( in_array( 'POST', $methods ) ) {
                    $route['method'] = 'post';
                    $route['form'] = 'confirm';
                } else {
                    $route['method'] = 'get';
                    $route['form'] = '';
                }

                if(!isset($route['param'])) {
                    $route['param'] = $this->model;
                }

                $route['route'] = route($route['route'], $route['param']);

                array_push($routes, $route);
            }
        }

        return $routes;
    }

    /**
     * Render route button view
     *
     * @return array
     */
    public function routeButton()
    {
        return view('route-button::button')
                    ->with('model', $this->model)
                    ->with('routes', $this->route_button_data);
    }
}
