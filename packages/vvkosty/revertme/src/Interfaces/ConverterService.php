<?php

namespace vvkosty\revertme\Interfaces;

use SplFileInfo;

interface ConverterService
{

    /**
     * @param array $reversedFrames
     * @param array $delays
     *
     * @return string
     * @throws \Exception
     */
    public function createReversed(array $reversedFrames, array $delays): string;

    /**
     * @param SplFileInfo $uploadedFile
     *
     * @return array
     * @throws \Exception
     */
    public function getOriginalFramesData(SplFileInfo $uploadedFile): array;

}