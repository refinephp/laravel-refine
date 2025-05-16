<?php

use Refinephp\LaravelRefine\Filters\Strategies\AndFilter;
use Refinephp\LaravelRefine\Filters\Strategies\BetweenFilter;
use Refinephp\LaravelRefine\Filters\Strategies\ContainsCaseSensitiveFilter;
use Refinephp\LaravelRefine\Filters\Strategies\ContainsFilter;
use Refinephp\LaravelRefine\Filters\Strategies\EndsWithCaseSensitiveFilter;
use Refinephp\LaravelRefine\Filters\Strategies\EndsWithFilter;
use Refinephp\LaravelRefine\Filters\Strategies\EqualCaseSensitiveFilter;
use Refinephp\LaravelRefine\Filters\Strategies\EqualFilter;
use Refinephp\LaravelRefine\Filters\Strategies\GreaterOrEqualFilter;
use Refinephp\LaravelRefine\Filters\Strategies\GreaterThanFilter;
use Refinephp\LaravelRefine\Filters\Strategies\InFilter;
use Refinephp\LaravelRefine\Filters\Strategies\LessOrEqualFilter;
use Refinephp\LaravelRefine\Filters\Strategies\LessThanFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotBetweenFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotContainsFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotContainsSensitiveFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotEqualFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotInFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NotNullFilter;
use Refinephp\LaravelRefine\Filters\Strategies\NullFilter;
use Refinephp\LaravelRefine\Filters\Strategies\OrFilter;
use Refinephp\LaravelRefine\Filters\Strategies\StartsWithCaseSensitiveFilter;
use Refinephp\LaravelRefine\Filters\Strategies\StartsWithFilter;

return [
    'filters' => [
        EqualFilter::class,
        InFilter::class,
        BetweenFilter::class,
        ContainsFilter::class,
        EndsWithFilter::class,
        GreaterThanFilter::class,
        NotNullFilter::class,
        StartsWithFilter::class,
        GreaterOrEqualFilter::class,
        LessOrEqualFilter::class,
        LessThanFilter::class,
        NotContainsFilter::class,
        NotBetweenFilter::class,
        NotEqualFilter::class,
        NotInFilter::class,
        NullFilter::class,
        AndFilter::class,
        OrFilter::class,
        NotContainsSensitiveFilter::class,
        StartsWithCaseSensitiveFilter::class,
        EndsWithCaseSensitiveFilter::class,
        EqualCaseSensitiveFilter::class,
        ContainsCaseSensitiveFilter::class,
    ],

    'silent' => true,

    'custom_filters_location' => app_path('Filters'),

    'null_last' => false,

];
