# Laravel Route Button

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)
[![Total Downloads](https://img.shields.io/packagist/dt/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)
[![License](https://img.shields.io/packagist/l/wtfz/laravel-route-button)](https://packagist.org/packages/wtfz/laravel-route-button)

Generate route buttons with dropdown from the model.

## Requirements

- [Laravel 8](https://laravel.com)
- [rappasoft/laravel-boilerplate (version 8)](https://www.github.com/rappasoft/laravel-boilerplate/)

## Installation

You can install the package via composer:

```bash
composer require wtfz/laravel-route-button
```

## Usage

Add this code in your model and define each route buttons in array inside your model

```php
use Wtfz\LaravelRouteButton\RouteButton;

class YourModel extends Model
{
    use RouteButton;

    protected $routeButton = [
                            [
                                'route' => 'admin.auth.user.edit',
                                'text' => 'Edit User',
                                'param' => [$this, 1], // Default: $model
                            ],
                            // ...
                        ];
}
```

Render route button in your model view (or any model loop)

```php
{{ $model->routeButton() }}

// or

@foreach($models as $model)
    {{ $model->routeButton() }}
@endforeach

// or in Livewire table

Column::make(__('Actions'), 'id')
    ->format(function ($value, $column, $row) {
        return $column->routeButton();
    }),
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ahmadzaimhamzah@gmail.com instead of using the issue tracker.

## Credits

-   [Ahmad Zaim](https://github.com/wtfz)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
