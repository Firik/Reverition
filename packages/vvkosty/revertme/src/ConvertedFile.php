<?php

namespace vvkosty\revertme;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ConvertedFile extends Model
{

    protected $attributes = [
        'downloads' => 0,
    ];
    private $filenamePrefix = 'reverted_';

    /**
     * @param string $rawFileData
     */
    public function saveToDisk(string $rawFileData): void
    {
        $this->attributes['size'] = strlen($rawFileData);
        $this->attributes['link'] = Storage::url($this->name);
        Storage::disk('local')->put('public/' . $this->name, $rawFileData);
    }

    /**
     * @return string
     */
    public function getRelativeUrl(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getAbsoluteUrl(): string
    {
        return asset($this->link);
    }

    public function deleteFromDisk(): void
    {
        Storage::disk('local')->delete('public/' . $this->name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->attributes['name'] = $this->filenamePrefix . $name;
    }
}
