<?php

namespace Refinephp\LaravelRefine\Tests\App\Models;

use Refinephp\LaravelRefine\Traits\Filterable;
use Refinephp\LaravelRefine\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
