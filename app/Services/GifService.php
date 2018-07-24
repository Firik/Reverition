<?php

namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;

class GifService {
    /**
     * @param Request $request
     * @return string
     * @throws \ImagickException
     */
    public function loadGif(Request $request): string {
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('gif');

        $originalGif = new Imagick();
        $originalGif->readImage($uploadedFile->getRealPath());

        $delay = $originalGif->getImageDelay();
        $reversedFrames = $this->getReversedFrames($originalGif);
        $revertedAnimation = $this->createReversedGif($reversedFrames, $delay);

        $filename = 'reverted_' . explode('/', $path)[1];
        $this->saveGif($filename, $revertedAnimation);

        $originalGif->clear();
        $originalGif->destroy();
        $revertedAnimation->clear();
        $revertedAnimation->destroy();

        return Storage::url($filename);
    }

    /**
     * @param array $reversedFrames
     * @param int $delay
     * @return Imagick
     * @throws \ImagickException
     */
    private function createReversedGif(array $reversedFrames, int $delay): Imagick {
        $animation = new Imagick();
        $animation->setFormat('gif');
        foreach ($reversedFrames as $frame) {
            $animation->readImageBlob($frame);
            $animation->setImageDelay($delay);
            $animation->setImageIterations(0);
        }
        $animation->mergeImageLayers(Imagick::LAYERMETHOD_OPTIMIZEPLUS);

        return $animation;
    }

    /**
     * @param Imagick $originalGif
     * @return array
     */
    private function getReversedFrames(Imagick $originalGif): array {
        $reversedFrames = [];
        foreach ($originalGif as $frame) {
            $reversedFrames[] = $frame->getImageBlob();
        }

        $lastFrame = array_pop($reversedFrames);
        $firstFrame = $reversedFrames[0];
        $reversedFrames[0] = $lastFrame;
        $reversedFrames[] = $firstFrame;
        $reversedFrames = array_reverse($reversedFrames);
        return $reversedFrames;
    }

    /**
     * @param string $filename
     * @param Imagick $animation
     * @throws \ImagickException
     */
    private function saveGif(string $filename, Imagick $animation): void {
        $animation->writeImages($filename, true);
        Storage::disk('local')->put('public/' . $filename, $animation->getImagesBlob());
    }
}