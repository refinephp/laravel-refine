<?php

namespace Refinephp\LaravelRefine\Filters\Strategies;

use Refinephp\LaravelRefine\Filters\Filter;
use Closure;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class EndsWithCaseSensitiveFilter extends Filter
{
    /**
     * Operator string to detect in the query params.
     *
     * @var string
     */
    protected static string $operator = '$endsWithc';

    /**
     * Apply filter logic to $query.
     *
     * @return Closure
     */
    public function apply(): Closure
    {
        return function ($query) {
            $connection = DB::connection()->getDriverName();

            foreach ($this->values as $value) {
                switch ($connection) {
                    case 'mariadb':
                    case 'mysql':
                        $query->whereRaw("BINARY `{$this->column}` like ?", '%' . $value);
                        break;
                    case 'sqlite':
                        $query->whereRaw("`{$this->column}` COLLATE BINARY like ?", '%' . $value);
                        break;
                    case 'pgsql':
                        $query->where($this->column, 'LIKE', '%' . $value);
                        break;
                    case 'sqlsrv':
                        $query->whereRaw("`{$this->column}` COLLATE Latin1_General_BIN LIKE ?", '%' . $value);
                        break;
                    default:
                        throw new RuntimeException("Unsupported database driver: {$connection}");
                }
            }
        };
    }
}
