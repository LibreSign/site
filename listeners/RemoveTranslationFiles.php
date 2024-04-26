<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\Jigsaw;

class RemoveTranslationFiles
{
    private Jigsaw $jigsaw;
    private Filesystem $filesystem;
    private array $langs;

    public function handle(Jigsaw $jigsaw)
    {
        $this->filesystem = $jigsaw->getFilesystem();
        $this->jigsaw = $jigsaw;
        $this->langs = $this->jigsaw->getSiteData()->localization->keys()->all();
        $source = $this->jigsaw->getSourcePath();
        $path = "{$source}/_posts";
        $items = collect($this->filesystem->files($path))
            ->filter(function ($file) {
                foreach ($this->langs as $lang) {
                    if (Str::startsWith($file->getFilename(), $lang)) {
                        return true;
                    }
                }
                return false;
            })->each(function ($collection) {
                $this->filesystem->delete($collection->getPathName());
            });
    }
}
