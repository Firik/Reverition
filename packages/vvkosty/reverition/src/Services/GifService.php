<?php

namespace vvkosty\reverition\Services;


use GifCreator\GifCreator;
use GifFrameExtractor\GifFrameExtractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GifService
{
    private $filename = '';

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function load(Request $request): string
    {
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('gif');

        $originalGif = new GifFrameExtractor();
        $originalFrames = $originalGif->extract($uploadedFile->getRealPath());

        $reversedFrames = $this->getReversedFrames($originalFrames);
        $durations = $originalGif->getFrameDurations();
        $revertedAnimationString = $this->createReversedGif($reversedFrames, $durations);

        $this->filename = 'reverted_' . explode('/', $path)[1];
        $this->saveGif($this->filename, $revertedAnimationString);

        return true;
    }

    /**
     * @param array $originalFrames
     * @return array
     */
    private function getReversedFrames(array $originalFrames): array
    {
        return array_reverse($originalFrames);
    }

    /**
     * @param array $reversedFrames
     * @param array $delays
     * @return string
     * @throws \Exception
     */
    private function createReversedGif(array $reversedFrames, array $delays): string
    {
        $animation = new GifCreator();
        $animation->create(array_column($reversedFrames, 'image'), $delays);
        return $animation->getGif();
    }

    /**
     * @param string $filename
     * @param string $animation
     */
    private function saveGif(string $filename, string $animation): void
    {
        Storage::disk('local')->put('public/' . $filename, $animation);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return Storage::url($this->filename);
    }
}
