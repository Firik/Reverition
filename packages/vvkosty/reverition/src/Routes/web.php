<?php


use vvkosty\reverition\Controllers\Media\MediaController;
use Illuminate\Support\Facades\Route;

Route::post('/load', MediaController::class . '@load');