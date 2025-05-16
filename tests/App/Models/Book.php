<?php

namespace Refinephp\LaravelRefine\Tests\App\Models;

use Refinephp\LaravelRefine\Traits\Filterable;
use Refinephp\LaravelRefine\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use Filterable;
    use Sortable;

    protected $filterFields = [
        'name', // field
        'description', // field
    ];

    protected $fillable = [
        'name',
        'description',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function posts(): MorphMany
    {
        return $this->morphMany(Post::class, 'postable');
    }
}
