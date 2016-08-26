<?php

namespace Hlacos\LaraMvcms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class LaraMvcmsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }

        require __DIR__.'/helpers.php';

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lara-mvcms');
        $this->publishes([
            __DIR__.'/../resources/views/' => base_path('resources/views/vendor/lara-mvcms')
        ], 'views');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lara-mvcms');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('lara-mvcms.php'),
        ]);

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/lara-mvcms'),
        ], 'public');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer(
            ['lara-mvcms::layouts.application'], 'Hlacos\LaraMvcms\Http\ViewComposers\ApplicationLayoutComposer'
        );

        view()->composer(
            ['lara-mvcms::layouts._admin-menu'], 'Hlacos\LaraMvcms\Http\ViewComposers\AdminMenuComposer'
        );
    }
}
