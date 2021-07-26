<?php

namespace Uasoft\Badaso\Module\POS\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
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

        $router = $this->app->make(Router::class);

        $this->app->singleton('badaso-POS-module', function () {
            return new BadasoPOSModule();
        });

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        $this->publishes([
            __DIR__.'/../Config/badaso-POS.php' => config_path('badaso-POS.php'),
        ], 'badaso-POS-config');
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
