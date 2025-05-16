<?php

namespace Refinephp\LaravelRefine\Tests;

use Refinephp\LaravelRefine\LaravelRefineServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/App/Migrations');
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelRefineServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-refine.silent', false);
    }
}
