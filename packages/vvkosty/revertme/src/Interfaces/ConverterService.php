<?php

namespace vvkosty\revertme\Interfaces;

use Illuminate\Http\UploadedFile;

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
     * @param UploadedFile $uploadedFile
     *
     * @return array
     * @throws \Exception
     */
    public function getFrames(UploadedFile $uploadedFile): array;

    /**
     * @param array $originalFrames
     * @param array $durations
     *
     * @return string
     * @throws \Exception
     */
    public function getRevertedData(array $originalFrames, array $durations): string;
}