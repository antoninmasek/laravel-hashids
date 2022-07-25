# Simple Laravel wrapper around Hashids library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/antoninmasek/laravel-hashids.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-hashids)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/antoninmasek/laravel-hashids/run-tests?label=tests)](https://github.com/antoninmasek/laravel-hashids/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/antoninmasek/laravel-hashids/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/antoninmasek/laravel-hashids/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/antoninmasek/laravel-hashids.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-hashids)

This package introduces a simple fluent interface for [Hashids](https://hashids.org/php/) package.

## Installation

You can install the package via composer:

```bash
composer require antoninmasek/laravel-hashids
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-hashids-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * If you wish to globally redefine the default alphabet you may do so below. If set to
     * null, then the default value defined in the Hashids library is used.
     *
     * Please make sure your alphabet has at least 16 characters as that is the minimum
     * length of the alphabet the Hashids package requires.
     *
     * @see \Hashids\Hashids::__construct
     */
    'alphabet' => null,

    /**
     * If you wish to globally redefine the default salt you may do so below. If set to
     * null, then the default value defined in the Hashids library is used.
     *
     * @see \Hashids\Hashids::__construct
     */
    'salt' => null,

    /**
     * If you wish to globally redefine the default minimum length of the hash you may do so
     * below. If set to null, then the default value defined in the Hashids library is used.
     *
     * Please note, that this is minimum length and not exact length. This means, that if
     * you specify, for example, 5 the resulting hash id can have length of 5 characters
     * or more.
     *
     * @see \Hashids\Hashids::__construct
     */
    'min_length' => null,
];
```

## Usage

```php
use AntoninMasek\Hashids\Facades\Hashids;

Hashids::encode(1);
Hashids::decode('jR');

// With configuration
Hashids::alphabet('1234567890qwertz')->encode(1);
Hashids::salt('your-salt')
    ->minLength(10)
    ->encode(1)
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Antonín Mašek](https://github.com/antoninmasek)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Special thanks

- To [Spatie](https://spatie.be/) for their amazing [skeleton](https://github.com/spatie/package-skeleton-laravel) which
  I used to scaffold this repository.
