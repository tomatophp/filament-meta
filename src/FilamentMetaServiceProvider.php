<?php

namespace TomatoPHP\FilamentMeta;

use Illuminate\Support\ServiceProvider;


class FilamentMetaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentMeta\Console\FilamentMetaInstall::class,
        ]);
 
        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-meta.php', 'filament-meta');
 
        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-meta.php' => config_path('filament-meta.php'),
        ], 'filament-meta-config');
 
        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
 
        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'filament-meta-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-meta');
 
        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-meta'),
        ], 'filament-meta-views');
 
        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-meta');
 
        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-meta'),
        ], 'filament-meta-lang');
 
        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
 
    }

    public function boot(): void
    {
        //you boot methods here
    }
}