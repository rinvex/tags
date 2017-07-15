<?php

declare(strict_types=1);

namespace Rinvex\Taggable;

use Illuminate\Support\ServiceProvider;

class TaggableServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/config.php'), 'rinvex.taggable');
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Load migrations
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            // Publish Resources
            $this->publishResources();
        }
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    protected function publishResources()
    {
        $this->publishes([realpath(__DIR__.'/../config/config.php') => config_path('rinvex.taggable.php')], 'rinvex-taggable-config');
        $this->publishes([realpath(__DIR__.'/../database/migrations') => database_path('migrations')], 'rinvex-taggable-migrations');
    }
}
