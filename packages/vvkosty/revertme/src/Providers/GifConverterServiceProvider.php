<?php


namespace vvkosty\revertme\Providers;

use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;
use Illuminate\Support\ServiceProvider;
use vvkosty\revertme\Interfaces\ConverterService;
use vvkosty\revertme\Services\GifConverterService;

class GifConverterServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConverterService::class, function ($app) {
            return new GifConverterService(
                $app->make(GifCreator::class),
                $app->make(GifFrameExtractor::class)
            );
        });
    }
}