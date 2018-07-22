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
        $originalGif->readImageBlob(Storage::disk('local')->get($path));

        $delay = $originalGif->getImageDelay();
        $reversedFrames = $this->getReversedFrames($originalGif);
        $revertedAnimation = $this->createReversedGif($reversedFrames, $delay);

        $filename = 'reverted_' . explode('/', $path)[1];
        $this->saveGif($filename, $revertedAnimation);

        $originalGif->clear();
        $originalGif->destroy();
        $revertedAnimation->clear();
        $revertedAnimation->destroy();

        return 'Gif loaded';
    }

    /**
     * @param Imagick $originalGif
     * @return array
     */
    private function getReversedFrames(Imagick $originalGif): array {
        $reversedFrames = [];
        foreach ($originalGif as $frame) {
            $reversedFrames[] = $frame->getImage();
        }

        return array_reverse($reversedFrames);
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
        $firstFrame = null;
        foreach ($reversedFrames as $frame) {
            $animation->addImage($frame);
            $animation->setImageDelay($delay);
            $animation->nextImage();
        }

        return $animation;
    }

    /**
     * @param string $filename
     * @param Imagick $animation
     * @throws \ImagickException
     */
    private function saveGif(string $filename, Imagick $animation): void {
        $animation->writeImages($filename, true);
        Storage::disk('local')->put($filename, $animation->getImagesBlob());
    }
}