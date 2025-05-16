<?php

namespace Refinephp\LaravelRefine;

use Refinephp\LaravelRefine\Console\FilterMakeCommand;
use Illuminate\Support\ServiceProvider;

class LaravelRefineServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-refine.php', 'laravel-refine');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-refine.php' => config_path('laravel-refine.php'),
            ], 'laravel-refine');

            $this->commands([
                FilterMakeCommand::class,
            ]);
        }
    }
}
