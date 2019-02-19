<?php

namespace vvkosty\reverition\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use vvkosty\reverition\Services\GifService;

class MediaController extends Controller {
    private $service;

    public function __construct(GifService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function load(Request $request): string {
        $this->service->load($request);
        return $this->service->getUrl();
    }

    public function result() {
        return \view('result');
    }
}
