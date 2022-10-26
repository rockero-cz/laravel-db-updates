# Laravel Database Updates

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/rockero-cz/laravel-db-updates)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rockero-cz/laravel-db-updates/run-tests?label=tests)](https://github.com/rockero-cz/laravel-db-updates/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rockero-cz/laravel-db-updates/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rockero-cz/laravel-db-updates/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-db-updates)

## Installation

You can install the package via composer:

```bash
composer require rockero-cz/laravel-db-updates
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="db-updates-migrations"
php artisan migrate
```

## Generating Updates

```bash
php artisan make:update update_name
```

## Running Updates

```bash
php artisan db:update
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
