<?php

namespace Anas\Markdown;

use Illuminate\Support\ServiceProvider;

class AnasMarkdownBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {

    }
}