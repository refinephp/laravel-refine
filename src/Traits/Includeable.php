<?php

namespace Refinephp\LaravelRefine\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

trait Includeable
{
    /**
     * Scope to eager load relationships based on the 'includes' query parameter.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeWithIncludes(Builder $query): Builder
    {
        $includes = Request::query('includes');

        if ($includes) {
            $relations = array_map('trim', explode(',', $includes));
            $allowed = $this->allowedIncludes ?? [];

            // Filter relations to include only allowed ones
            $filtered = array_intersect($relations, $allowed);

            return $query->with($filtered);
        }

        return $query;
    }
}
