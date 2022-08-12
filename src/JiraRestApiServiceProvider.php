<?php

namespace JiraCloud;

use Illuminate\Support\ServiceProvider;
use JiraCloud\Configuration\ConfigurationInterface;
use JiraCloud\Configuration\DotEnvConfiguration;

class JiraCloudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind(ConfigurationInterface::class, function () {
            return new DotEnvConfiguration(base_path());
        });
    }
}
