<?php

namespace App\Http\Controllers\Gif;

use App\Http\Controllers\Controller;
use App\Services\GifService;
use Illuminate\Http\Request;

class GifController extends Controller {
    private $service;

    public function __construct() {
        $this->service = new GifService();
    }

    /**
     * @param Request $request
     * @return string
     * @throws \ImagickException
     */
    public function load(Request $request): string {
        return $this->service->loadGif($request);
    }
}
