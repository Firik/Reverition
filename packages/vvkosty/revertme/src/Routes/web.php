<?php


use Illuminate\Support\Facades\Route;
use vvkosty\revertme\Controllers\Media\MediaController;
use vvkosty\revertme\Middleware\ErrorIfNotGifFile;

Route::post('/load', MediaController::class . '@load')
    ->middleware(['web', ErrorIfNotGifFile::class]);