<?php

namespace Anas\Markdown\Tests;

use Anas\Markdown\AnasMarkdownBaseServiceProvider;
use Anas\Markdown\database\factories\PostFactory;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(PostFactory::class);
    }


    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app)
    {
        return [
            AnasMarkdownBaseServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default' , 'testdb');
        $app['config']->set('database.connections.testdb' , [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
    }

}