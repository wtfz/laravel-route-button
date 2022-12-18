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

[SweetAlert2](https://github.com/sweetalert2/sweetalert2) modal was used when clicking any routes with DELETE, PATCH or POST method.

To customize (or remove SweetAlert2 dependency), publish and edit the component (`resources/views/vendor/route-button`).

```php
php artisan vendor:publish --tag=laravel-route-button
```

## Usage

Add this code and define each route buttons inside your model.

```php
use Wtfz\LaravelRouteButton\RouteButton;

class YourModel extends Model
{
    use RouteButton;

    // global route button
    protected $routeButton = [
            [
                'route' => 'admin.auth.user.edit',
                'text' => 'Edit User',
                'args' => [$this, 1], // Optional, default: $model
            ],
            // ...
        ];

    // or named route button
    protected $routeButton = [
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

    // or mixed route button
    protected $routeButton = [
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

Render route button inside your view. Links render (global, named, mixed) depends on definition of $routeButton in your model.

```php
// global route button
{{ $model->routeButton() }}

// named route button
{{ $model->routeButton('index') }}

// or...

@foreach($models as $model)
    // global route button
    {{ $model->routeButton() }}

    // named route button
    {{ $model->routeButton('edit') }}
@endforeach

// or in Livewire table...

Column::make(__('Actions'), 'id')
    ->format(function ($value, $column, $row) {
        return $column->routeButton('index');
    }),
```

## License

Copyright © Ahmad Zaim

The [MIT License](LICENSE.md) (MIT)
