<?php

namespace Vrnvgasu\Localization\Providers;

use Illuminate\Support\ServiceProvider;
use Vrnvgasu\Localization\Contracts\LocaleServiceContract;
use Vrnvgasu\Localization\Middleware\Localization;
use Vrnvgasu\Localization\Services\LocaleService;

/**
 * Class LocalizationProvider
 * @package Vrnvgasu\Localization\Providers
 */
class LocalizationProvider extends ServiceProvider
{
    const ROOT = __DIR__ . '/../../';

    /**
     * @var array
     */
    public $bindings = [
        LocaleServiceContract::class => LocaleService::class,
    ];

    public function boot(): void
    {
        $this->loadRoutesFrom(static::ROOT . 'routes/web.php');
        $this->loadMigrationsFrom(static::ROOT . 'migrations');

        $this->loadConfigs();
        $this->loadViews();

        app('router')->aliasMiddleware(Localization::ALIAS, Localization::class);
    }

    private function loadConfigs(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                static::ROOT . 'config/vrnvgasu_localization.php' => config_path('vrnvgasu_localization.php'),
            ], 'vrnvgasu_localization__config');
        }
        $this->mergeConfigFrom(static::ROOT . 'config/vrnvgasu_localization.php', 'vrnvgasu_localization');
    }

    private function loadViews(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                static::ROOT . 'resources/views' => resource_path('views/vendor/vrnvgasu'),
            ], 'vrnvgasu_localization__view');
        }
        $this->loadViewsFrom(static::ROOT . 'resources/views', 'vrnvgasu');
    }
}
