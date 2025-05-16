<?php

namespace Refinephp\LaravelRefine\Filters\Strategies;

use Refinephp\LaravelRefine\Filters\Filter;
use Closure;

class BetweenFilter extends Filter
{
    /**
     * Operator string to detect in the query params.
     *
     * @var string
     */
    protected static string $operator = '$between';

    /**
     * Apply filter logic to $query.
     *
     * @return Closure
     */
    public function apply(): Closure
    {
        return function ($query) {
            $query->whereBetween($this->column, $this->values);
        };
    }
}
