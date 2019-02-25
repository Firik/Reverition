<?php


use vvkosty\reverition\Controllers\Media\MediaController;
use Illuminate\Support\Facades\Route;
use vvkosty\reverition\Middleware\ErrorIfNotGifFile;

Route::post('/load', MediaController::class . '@load')->middleware(ErrorIfNotGifFile::class);