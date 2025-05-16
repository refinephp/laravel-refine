<?php

namespace Refinephp\LaravelRefine\Filters;

use Refinephp\LaravelRefine\Contracts\Filter;
use ReflectionClass;
use ReflectionException;

class FilterList
{
    public array $filters = [];

    public function __construct()
    {
        $this->loadDefault();
        $this->loadCustom();
    }

    private function loadDefault(): void
    {
        $this->filters += $this->extract(config('laravel-refine.filters'));
    }

    private function extract(array $classes): array
    {
        $result = [];
        foreach ($classes as $class) {
            $result[$class::operator()] = $class;
        }

        return $result;
    }

    private function loadCustom(): void
    {
        $classes = $this->load(config('laravel-refine.custom_filters_location'));

        $this->filters += $this->extract($classes);
    }

    private function load(string $directory): array
    {
        $files = glob("$directory/*.php", GLOB_NOSORT);

        $classes = [];

        foreach ($files as $file) {
            require_once $file;

            // Extract the namespace and class name
            $contents = file_get_contents($file);
            preg_match('/namespace\s+([^;]+);/', $contents, $matches);
            $namespace = isset($matches[1]) ? $matches[1] . '\\' : '';
            $class_name = basename($file, '.php');

            $classes[] = $full_class_name = $namespace . $class_name;
        }

        return $classes;
    }

    public function only(array $filters): FilterList
    {
        foreach ($filters as $key => $filter) {
            try {
                $ReflectedClass = new ReflectionClass($filter);
                if ($ReflectedClass->isSubclassOf(Filter::class)) {
                    $filters[$key] = $filter::operator();
                }
            } catch (ReflectionException) {
            }
        }

        $this->filters = collect($this->filters)->only($filters)->all();

        return $this;
    }

    public function keys(): array
    {
        return array_keys($this->filters);
    }

    public function get(string $operator)
    {
        return $this->filters[$operator] ?? null;
    }
}
