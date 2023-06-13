<picture>
    <source
        media="(prefers-color-scheme: dark)"
        srcset="https://banners.beyondco.de/Laravel%20DB%20Updates.png?theme=dark&packageManager=composer+require&packageName=rockero-cz%2Flaravel-db-updates&pattern=graphPaper&style=style_1&description=Fix+or+update+your+data+easily+with+database+updates.&md=1&showWatermark=0&fontSize=100px&images=database"
    />
      <img alt="Banner" src="https://banners.beyondco.de/Laravel%20DB%20Updates.png?theme=light&packageManager=composer+require&packageName=rockero-cz%2Flaravel-db-updates&pattern=graphPaper&style=style_1&description=Fix+or+update+your+data+easily+with+database+updates.&md=1&showWatermark=0&fontSize=100px&images=database">
</picture>

# Laravel DB Updates

[![Rockero](https://img.shields.io/badge/Rockero-yellow)](https://rockero.cz)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/rockero-cz/laravel-db-updates)
[![Total Downloads](https://img.shields.io/packagist/dt/rockero-cz/laravel-db-updates.svg?style=flat-square)](https://packagist.org/packages/rockero-cz/laravel-db-updates)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

In short, database updates package is used to update or fix your data in database. It works on the same principle as Laravel migrations.

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

**Below you can find some practical examples.**

Until now, a post could only have one image, now it can have multiple ones though, so you need to transfer your post image to the separate `images` table:

```php
/**
 * Run the updates.
 */
public function __invoke(): void
{
    Post::all()->each(function (Post $post) {
        $post->images()->create([
            'url' => $post->image,
            'title' => $post->title
        ]);
    });
}
```

Your production database had some testing data and you finally decided to delete them, so you need to delete all records older than `2023-01-01`:

```php
/**
 * Run the updates.
 */
public function __invoke(): void
{
    Post::query()
        ->where('created_at', '<', '2023-01-01')
        ->delete();

    User::query()
        ->where('created_at', '<', '2023-01-01')
        ->delete();
}
```

You have made some refactoring and you also renamed a state name, so you need to rename it in the database:

```php
/**
 * Run the updates.
 */
public function __invoke(): void
{
    Order::query()
        ->where('state', 'new')
        ->update(['state' => OrderState::CREATED]);
}
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
