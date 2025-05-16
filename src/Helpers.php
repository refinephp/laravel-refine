<?php

namespace Refinephp\LaravelRefine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use ReflectionClass;

class Helpers
{
    /**
     * list models relations.
     *
     * @param Model|string $model
     *
     * @throws \ReflectionException
     *
     * @return array
     */
    public static function getRelations(Model|string $model): array
    {
        $methods = (new ReflectionClass($model))->getMethods();

        return collect($methods)
            ->filter(
                fn($method) => !empty($method->getReturnType()) &&
                    str_contains(
                        $method->getReturnType(),
                        'Illuminate\Database\Eloquent\Relations'
                    )
            )
            ->map(fn($method) => $method->name)
            ->values()->all();
    }

    public static function getColumns(string $table): array
    {
        return Schema::getColumnListing($table);
    }

    public static function getAvailableSortColumns(Model $model): array
    {
        $rModel = new \ReflectionObject($model);

        if ($rModel->hasProperty('sortFields')) {
            $rProperty = $rModel->getProperty('sortFields');
            $rProperty->setAccessible(true);

            return $rProperty->getValue($model);
        }

        return self::getColumns($model->getTable());
    }
}
