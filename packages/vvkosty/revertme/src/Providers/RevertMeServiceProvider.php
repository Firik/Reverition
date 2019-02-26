<?php


namespace vvkosty\revertme\Providers;

use Illuminate\Support\ServiceProvider;
use vvkosty\revertme\Services\GifService;

class RevertMeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->publishes([
            __DIR__ . '/../resources/assets' => resource_path('assets/vendor/revertme')
        ], 'vue-components');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GifService::class, function () {
            return new GifService();
        });

        $this->app->alias(GifService::class, 'GifService');
    }
}