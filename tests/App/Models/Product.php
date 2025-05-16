<?php

namespace Refinephp\LaravelRefine\Tests\App\Models;

use Refinephp\LaravelRefine\Tests\App\Factories\ProductFactory;
use Refinephp\LaravelRefine\Traits\Filterable;
use Refinephp\LaravelRefine\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    protected $fillable = [
        'name',
        'price',
        'rate',
        'description',
        'is_available',
    ];

    public function posts(): MorphMany
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }
}
