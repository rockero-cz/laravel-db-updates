<picture>
    <source
        media="(prefers-color-scheme: dark)"
        srcset="https://banners.beyondco.de/Laravel%20DB%20Updates.png?theme=dark&packageManager=composer+require&packageName=rockero-cz%2Flaravel-db-updates&pattern=graphPaper&style=style_1&description=Fix+or+modify+your+data+easily+with+database+updates.&md=1&showWatermark=0&fontSize=100px&images=database"
    />
      <img alt="Banner" src="https://banners.beyondco.de/Laravel%20DB%20Updates.png?theme=light&packageManager=composer+require&packageName=rockero-cz%2Flaravel-db-updates&pattern=graphPaper&style=style_1&description=Fix+or+modify+your+data+easily+with+database+updates.&md=1&showWatermark=0&fontSize=100px&images=database">
</picture>

# Laravel DB Updates

[![Rockero](https://img.shields.io/badge/Rockero-yellow)](https://rockero.cz)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/rockero-cz/laravel-db-updates)
[![Total Downloads](https://img.shields.io/packagist/dt/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-db-updates)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

In short, database updates package is used to modify or fix your data in database. It works on the same principle as Laravel migrations.

Each `DB update` can be run only once across environments.

## Installation

Install the package via composer:

```bash
composer require rockero-cz/laravel-db-updates
```

Publish and run migrations with:

```bash
php artisan vendor:publish --tag="db-updates-migrations"
php artisan migrate
```

## Generating Updates

```bash
php artisan make:update update_name
```

```php
return new class
{
    /**
     * Run the updates.
     */
    public function __invoke(): void
    {
        //
    }
};
```

## Running Updates

```bash
php artisan db:update
```

## Usage Examples

Below you can find some practical examples:

```php
return new class
{
    /**
     * Run the updates.
     */
    public function __invoke(): void
    {
        //
    }
};
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
