<?php

namespace App\Http\Controllers\Gif;

use App\Services\GifService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GifController extends Controller {
    private $service;

    public function __construct() {
        $this->service = new GifService();
    }

    public function loadGif(): string {
        return $this->service->loadGif();
    }
}
