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
     * Get model name in snake case format.
     *
     * @return string
     */
    public function getRouteButtonNameAttribute()
    {
        return Str::snake( class_basename( get_class( $this ) ) );
    }

    /**
     * Get model name with id as a toggle key.
     *
     * @return string
     */
    public function getRouteButtonToggleAttribute()
    {
        return 'toggle_'.$this->route_button_name .'_'. $this->id;
    }

    /**
     * Get model name with id as a dropdown key.
     *
     * @return string
     */
    public function getRouteButtonDropdownAttribute()
    {
        return 'dropdown_'.$this->route_button_name .'_'. $this->id;
    }

    /**
     * Prepare route link for view.
     * 
     * @param array $route
     * @return object
     */
    public function prepareRoute($route)
    {
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

        if(!isset($route['args'])) {
            $route['args'] = $this;
        }

        $route['route'] = route($route['route'], $route['args']);

        return (object) $route;
    }

    /**
     * Load list of routes for view.
     * 
     * @param string $section
     * @return array
     */
    public function loadRoute($section = '')
    {
        $routes = collect();

        if( count(static::$routeButton) > 0 ){
            foreach( static::$routeButton as $key => $route ) {
                if (empty($section)) {
                    if (is_numeric($key)) {
                        $routes->push($this->prepareRoute($route));
                    }
                } else {
                    if ($section == $key) {
                        foreach($route as $_route) {
                            if(is_array($_route)) {
                                $routes->push($this->prepareRoute($_route));
                            }
                        }
                    }
                }
            }
        }

        return $routes;
    }

    /**
     * Render route button view
     * 
     * @param string $section
     * @return array
     */
    public function routeButton($section = '')
    {
        return view('route-button::button')
                    ->with('model', $this)
                    ->with('routes', $this->loadRoute($section));
    }
}
