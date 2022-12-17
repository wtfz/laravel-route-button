# Laravel Route Button

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wtfz/laravel-route-button.svg?style=flat-square)](https://packagist.org/packages/wtfz/laravel-route-button)
[![Total Downloads](https://img.shields.io/packagist/dt/wtfz/laravel-route-button.svg?style=flat-square)](https://packagist.org/packages/wtfz/laravel-route-button)
![GitHub Actions](https://github.com/wtfz/laravel-route-button/actions/workflows/main.yml/badge.svg)

Laravel Route Button simplify process to generate route buttons from the model. Use it in any model views (or datatables row).

## Installation

You can install the package via composer:

```bash
composer require wtfz/laravel-route-button
```

## Usage

Add this code in your model

```php
use Wtfz\LaravelRouteButton\RouteButton;

class YourModel extends Model
{
    use RouteButton;

    ...
}
```

Add this method and define each button for each route in your model

```php
public function routeItems()
{
    return [
        [
            'route' => 'admin.auth.user.edit',
            'text' => 'Edit User',
            'param' => [$this, 1], // Default: $model
        ],
        [
            ...
        ]
    ];
}
```

Render route button in your model view (or any model loop)

```php
{{ $model->routeButton() }}
```

```php
@foreach($models as $model)
    {{ $model->routeButton() }}
@endforeach
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
