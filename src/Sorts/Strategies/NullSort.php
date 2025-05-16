<?php

namespace Refinephp\LaravelRefine\Sorts\Strategies;

use Refinephp\LaravelRefine\Sorts\SortAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class NullSort extends SortAbstract
{
    public function apply(): Builder
    {
        return match (DB::getDriverName()) {
            'pgsql' => $this->query->orderByRaw("$this->column $this->direction nulls last"),
            default => $this->query->orderByRaw("$this->column is null")
                ->orderByRaw("$this->column $this->direction")
        };
    }
}
