<?php


use Illuminate\Support\Facades\Route;
use vvkosty\reverition\Controllers\Media\MediaController;
use vvkosty\reverition\Middleware\ErrorIfNotGifFile;

Route::post('/load', MediaController::class . '@load')
    ->middleware(['web', ErrorIfNotGifFile::class]);