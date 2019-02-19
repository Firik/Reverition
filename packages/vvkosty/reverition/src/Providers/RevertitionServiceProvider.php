<?php


namespace vvkosty\reverition\Providers;

use Illuminate\Support\ServiceProvider;
use vvkosty\reverition\Services\GifService;

class RevertitionServiceProvider extends ServiceProvider
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
            __DIR__ . '/../resources/assets' => resource_path('assets/vendor/reverition')
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