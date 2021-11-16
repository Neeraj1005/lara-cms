<?php

namespace Neeraj1005\Cms;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cms');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/cms.php' => config_path('cms.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cms'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/cms'),
            ], 'assets');*/

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/cms'),
            ], 'lang');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('cms.prefix'),
            'middleware' => config('cms.middleware'),
        ];
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/cms.php', 'cms');

        // Register the main class to use with the facade
        $this->app->singleton('cms', function () {
            return new Cms;
        });
    }
}
