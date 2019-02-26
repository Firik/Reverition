<?php

namespace vvkosty\revertme\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use vvkosty\revertme\Services\GifService;

class MediaController extends Controller {
    private $service;

    public function __construct(GifService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function load(Request $request): array {
        $this->service->load($request);
        return [
            'url' => $this->service->getUrl(),
            'filename' => $this->service->getFileName(),
            'redirectUrl' => 'result',
        ];
    }
}
