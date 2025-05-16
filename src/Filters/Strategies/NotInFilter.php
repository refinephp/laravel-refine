<?php

namespace Refinephp\LaravelRefine\Filters\Strategies;

use Refinephp\LaravelRefine\Filters\Filter;
use Closure;

class NotInFilter extends Filter
{
    /**
     * Operator string to detect in the query params.
     *
     * @var string
     */
    protected static string $operator = '$notIn';

    /**
     * Apply filter logic to $query.
     *
     * @return Closure
     */
    public function apply(): Closure
    {
        return function ($query) {
            $query->whereNotIn($this->column, $this->values);
        };
    }
}
