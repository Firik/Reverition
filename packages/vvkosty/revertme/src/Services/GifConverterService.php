<?php

namespace vvkosty\revertme\Services;


use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;
use Illuminate\Http\UploadedFile;
use vvkosty\revertme\Interfaces\ConverterService;

class GifConverterService implements ConverterService
{

    private $GifCreator;
    private $GifFrameExtractor;

    public function __construct(
        GifCreator $GifCreator,
        GifFrameExtractor $GifFrameExtractor
    ) {
        $this->GifCreator = $GifCreator;
        $this->GifFrameExtractor = $GifFrameExtractor;
    }

    /**
     * @param array $reversedFrames
     * @param array $delays
     *
     * @return string
     * @throws \Exception
     */
    public function createReversed(array $reversedFrames, array $delays): string
    {
        $this->GifCreator->create(array_column($reversedFrames, 'image'), $delays);
        return $this->GifCreator->getGif();
    }

    /**
     * @param UploadedFile $uploadedFile
     *
     * @return array
     * @throws \Exception
     */
    public function getFrames(UploadedFile $uploadedFile): array
    {
        $originalFrames = $this->GifFrameExtractor->extract($uploadedFile->getRealPath());
        $durations = $this->GifFrameExtractor->getFrameDurations();
        return [$originalFrames, $durations];
    }

    /**
     * @param array $originalFrames
     * @param array $durations
     *
     * @return string
     * @throws \Exception
     */
    public function getRevertedData(array $originalFrames, array $durations): string
    {
        return $this->createReversed(array_reverse($originalFrames), $durations);
    }

}
