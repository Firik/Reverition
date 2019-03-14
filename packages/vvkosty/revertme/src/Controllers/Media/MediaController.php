<?php

namespace vvkosty\revertme\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use vvkosty\revertme\ConvertedFile;
use vvkosty\revertme\Interfaces\ConverterService;

class MediaController extends Controller
{

    private $service;
    private $convertedFile;

    public function __construct(ConverterService $service, ConvertedFile $ConvertedFile)
    {
        $this->service = $service;
        $this->convertedFile = $ConvertedFile;
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function load(Request $request): array
    {
        $uploadedFile = $request->file('file');
        $uploadedFile->store('gif');
        [$originalFrames, $durations] = $this->service->getOriginalFramesData($uploadedFile);
        $revertedAnimationString = $this->service->createReversed($originalFrames, $durations);

        $this->convertedFile->setName($uploadedFile->getClientOriginalName());
        $this->convertedFile->saveToDisk($revertedAnimationString);
        $this->convertedFile->save(); // TODO: remove model`s method call

        return [
            'url' => $this->convertedFile->getAbsoluteUrl(),
            'filename' => $this->convertedFile->getName(),
            'redirectUrl' => 'result',
        ];
    }
}
