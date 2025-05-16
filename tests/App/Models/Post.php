<?php

namespace Refinephp\LaravelRefine\Tests\App\Models;

use Refinephp\LaravelRefine\Traits\Filterable;
use Refinephp\LaravelRefine\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Refinephp\LaravelRefine\Traits\Includeable;

class Post extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;
    use Includeable;

    protected $allowedIncludes = [
        'comments',
        'user',
        'tags',
    ];

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function postable(): MorphTo
    {
        return $this->morphTo();
    }
}
