<?php

namespace Refinephp\LaravelRefine\Tests\App\Models;

use Refinephp\LaravelRefine\Traits\Filterable;
use Refinephp\LaravelRefine\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use Filterable;
    use Sortable;

    protected $filterFields = [
        'name', // field
        'books', // relation
    ];

    protected $fillable = [
        'name',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
