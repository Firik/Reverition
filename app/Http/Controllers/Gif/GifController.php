<?php

namespace App\Http\Controllers\Gif;

use App\Services\GifService;
use App\Http\Controllers\Controller;

class GifController extends Controller {
    private $service;

    public function __construct() {
        $this->service = new GifService();
    }

    public function load(): string {
        return $this->service->loadGif();
    }
}
