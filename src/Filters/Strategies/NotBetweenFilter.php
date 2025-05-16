<?php

namespace Refinephp\LaravelRefine\Filters\Strategies;

use Refinephp\LaravelRefine\Filters\Filter;
use Closure;

class NotBetweenFilter extends Filter
{
    /**
     * Operator string to detect in the query params.
     *
     * @var string
     */
    protected static string $operator = '$notBetween';

    /**
     * Apply filter logic to $query.
     *
     * @return Closure
     */
    public function apply(): Closure
    {
        return function ($query) {
            $query->whereNotBetween($this->column, $this->values);
        };
    }
}
