# Laravel Route Button

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)
[![Total Downloads](https://img.shields.io/packagist/dt/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)
[![License](https://img.shields.io/packagist/l/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)

Generate route buttons with dropdown from the model.

---

## Installation

```bash
composer require wtfz/laravel-route-button
```

## Customization

To customize, publish and edit the component.

```php
php artisan vendor:publish --tag=laravel-route-button
// resources/views/vendor/route-button
```

## Usage

Add this code and define each route buttons inside your model.

```php
use Wtfz\LaravelRouteButton\RouteButton;

class YourModel extends Model
{
    use RouteButton;

    // init empty route button
    public static $routeButton = [];

    // or init global route button
    public static $routeButton = [
            [
                'route' => 'admin.auth.user.delete',
                'text' => 'Delete User',
                'view' => 'frontend.profile.confirm',
                'args' => [$this, 1], // Optional, default: $model
            ],
            // ...
        ];

    // or init named route button
    public static $routeButton = [
            'index' => [
                'route' => 'admin.auth.user.edit',
                'text' => 'Edit User'
            ],
            'edit' => [
                'route' => 'admin.auth.user.destroy',
                'text' => 'Destroy User'
            ],
            // ...
        ];

    // or init mixed route button
    public static $routeButton = [
            [
                'route' => 'admin.auth.user.edit',
                'text' => 'Edit User',
                'args' => [$this, 1], // Optional, default: $model
            ],
            'index' => [
                'route' => 'admin.auth.user.edit',
                'text' => 'Edit User'
            ],
            'edit' => [
                'route' => 'admin.auth.user.destroy',
                'text' => 'Destroy User'
            ],
            // ...
        ];
}
```

Render route button inside your view by calling it from your model.

```php
// global route button
{{ $model->routeButton() }}

// named route button
{{ $model->routeButton('edit') }}

// or in Livewire table...
Column::make(__('Actions'), 'id')
    ->format(function ($value, $row, $column) {
        return $row->routeButton('edit');
    }),

// or add new route button on the fly...
Column::make(__('Actions'), 'id')
    ->format(function ($value, $row, $column) {
        // for global route (set integer index)
        $row::$routeButton[0][] = [
            'route' => 'admin.auth.user.delete',
            'text' => 'Delete User',
            'args' => ['type' => 'member', 'user' => $row],
        ];

        // for named route (set string index)
        $row::$routeButton['edit'][] = [
            'route' => 'admin.auth.user.delete',
            'text' => 'Delete User',
            'args' => ['type' => 'member', 'user' => $row],
        ];

        return $row->routeButton('index');
    }),
```

## License

Copyright © Ahmad Zaim

The [MIT License](LICENSE.md) (MIT)
