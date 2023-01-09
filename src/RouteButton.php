<?php

namespace Wtfz\LaravelRouteButton;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

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
    public function getLrbNameIdAttribute(): string
    {
        return Str::snake( class_basename( get_class( $this ) ) );
    }

    /**
     * Get modal id.
     *
     * @return string
     */
    public function getLrbModalIdAttribute(): string
    {
        return 'modal_'.$this->lrb_name_id .'_'. $this->id;
    }

    /**
     * Get modal button id.
     *
     * @return string
     */
    public function getLrbModalButtonIdAttribute(): string
    {
        return 'modal_button_'.$this->lrb_name_id .'_'. $this->id;
    }

    /**
     * Get toggle id.
     *
     * @return string
     */
    public function getLrbToggleIdAttribute(): string
    {
        return 'toggle_'.$this->lrb_name_id .'_'. $this->id;
    }

    /**
     * Get dropdown id.
     *
     * @return string
     */
    public function getLrbDropdownIdAttribute():string
    {
        return 'dropdown_'.$this->lrb_name_id .'_'. $this->id;
    }

    /**
     * Prepare route link for view.
     * 
     * @param array $route
     * @return object
     */
    public function prepareRoute($route): object
    {
        $methods = Route::getRoutes()->getByName($route['route'])->methods();
        $methods = is_array($methods) ? $methods : [$methods];

        $route['lrb_method'] = '';
        if( in_array( 'DELETE', $methods ) ) {
            $route['lrb_method'] = 'delete';
        } elseif( in_array( 'PATCH', $methods ) ) {
            $route['lrb_method'] = 'patch';
        } elseif( in_array( 'POST', $methods ) ) {
            $route['lrb_method'] = 'post';
        }

        if( isset( $route['view'] ) ) {
            $route['lrb_html'] = View::make( $route['view'] );
        } else {
            if( in_array( $route['lrb_method'], ['delete'] ) ) {
                $route['lrb_html'] = View::make( 'route-button::_delete' );
            } elseif( in_array( $route['lrb_method'], ['patch', 'post'] ) ) {
                $route['lrb_html'] = View::make( 'route-button::_confirm' );
            } else {
                $route['lrb_html'] = null;
            }
        }

        $hash = bin2hex(random_bytes(10));

        $new_route = [
            'lrb_method' => $route['lrb_method'],
            'lrb_html' => $route['lrb_html'],
            'lrb_toggle_id' => $this->lrb_toggle_id.$hash,
            'lrb_dropdown_id' => $this->lrb_dropdown_id.$hash,
            'lrb_text' => $route['text'] ?? null,
            'lrb_name' => $route['name'] ?? null,
            'lrb_args' => $route['args'] ?? $this,
            'lrb_url' => URL::route( $route['route'], $route['args'] ?? $this ),
            'lrb_modal_id' => $this->lrb_modal_id.$hash,
            'lrb_modal_button_id' => $this->lrb_modal_button_id.$hash,
        ];

        return (object) $new_route;
    }

    /**
     * Load list of routes for view.
     * 
     * @param string $section
     * @return Collection
     */
    public function loadRoute($section = ''): Collection
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
     * @return \Illuminate\Contracts\View\View
     */
    public function routeButton($section = '')
    {
        return View::make('route-button::view')->with('routes', $this->loadRoute($section));
    }
}
