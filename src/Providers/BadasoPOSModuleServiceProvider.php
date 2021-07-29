<?php

namespace Uasoft\Badaso\Module\POS\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Uasoft\Badaso\Module\POS\BadasoPOSModule;
use Uasoft\Badaso\Module\POS\Commands\BadasoPOSSetup;
use Uasoft\Badaso\Module\POS\Facades\BadasoPOSModule as FacadesBadasoPOSModule;

class BadasoPOSModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('FacadesBadasoPOSModule', FacadesBadasoPOSModule::class);

        $this->app->singleton('badaso-POS-module', function () {
            return new BadasoPOSModule();
        });

        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'badaso_pos');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pos-module');

        $this->publishes([
            __DIR__.'/../Seeder' => database_path('seeders/Badaso/POS'),
            __DIR__.'/../Config/badaso-POS.php' => config_path('badaso-POS.php'),
        ], 'badaso-POS-setup');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommands();
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(BadasoPOSSetup::class);
    }
}
