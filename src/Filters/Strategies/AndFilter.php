<?php

namespace Refinephp\LaravelRefine\Filters\Strategies;

use Refinephp\LaravelRefine\Filters\Filter;
use Refinephp\LaravelRefine\Filters\Resolve;
use Closure;

class AndFilter extends Filter
{
    /**
     * Operator string to detect in the query params.
     *
     * @var string
     */
    protected static string $operator = '$and';

    /**
     * Apply filter logic to $query.
     *
     * @return Closure
     */
    public function apply(): Closure
    {
        return function ($query) {
            foreach ($this->values as $value) {
                $query->where(function ($query) use ($value) {
                    foreach ($value as $key => $item) {
                        app(Resolve::class)->apply($query, $key, $item);
                    }
                });
            }
        };
    }
}
