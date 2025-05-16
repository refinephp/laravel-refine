# Laravel Refine

Laravel Refine is a package that provides elegant and efficient query filtering and sorting for Laravel applications.

## Installation

You can install the package via Composer:

```bash
composer require refinephp/laravel-refine
```

```bash
php artisan vendor:publish --tag=laravel-refine
```

## Basic Usage

### Filtering

To add filtering capabilities to your model, you can simply use the `Filterable` trait in your model:

```php
use Refinephp\LaravelRefine\Traits\Filterable;

class User extends Model
{
    use Filterable;
}
```
