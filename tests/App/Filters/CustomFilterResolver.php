<?php

namespace Refinephp\LaravelRefine\Tests\App\Filters;

use Refinephp\LaravelRefine\Filters\FilterList;
use Refinephp\LaravelRefine\Filters\Resolve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomFilterResolver extends Resolve
{
    public function __construct(FilterList $filterList, Model $model)
    {
        parent::__construct($filterList, $model);
    }

    public function apply(Builder $query, string $field, array|string $values): void
    {
        // do some custom logic
        if (isset($values['$refine']) && $values['$refine'] === 'true') {
            parent::apply($query, $field, ['$startsWith' => 'refine_']);

            return;
        }

        parent::apply($query, $field, $values);
    }
}
