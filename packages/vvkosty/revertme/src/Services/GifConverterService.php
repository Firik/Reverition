<?php

namespace vvkosty\revertme\Services;


use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;
use SplFileInfo;
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
     * @param array $originalFrames
     * @param array $delays
     *
     * @return string
     * @throws \Exception
     */
    public function createReversed(array $originalFrames, array $delays): string
    {
        $this->GifCreator->create(array_column(array_reverse($originalFrames), 'image'), $delays);
        return $this->GifCreator->getGif();
    }

    /**
     * @param SplFileInfo $uploadedFile
     *
     * @return array
     * @throws \Exception
     */
    public function getOriginalFramesData(SplFileInfo $uploadedFile): array
    {
        $originalFrames = $this->GifFrameExtractor->extract($uploadedFile->getRealPath());
        $durations = $this->GifFrameExtractor->getFrameDurations();
        return [$originalFrames, $durations];
    }

}
