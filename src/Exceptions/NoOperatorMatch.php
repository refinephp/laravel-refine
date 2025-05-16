<?php

namespace Refinephp\LaravelRefine\Exceptions;

use InvalidArgumentException;

class NoOperatorMatch extends InvalidArgumentException
{
    public static function create(array $filters)
    {
        return new static(
            'No operator matches your request. Supported operators : ' . implode(', ', $filters)
        );
    }
}
