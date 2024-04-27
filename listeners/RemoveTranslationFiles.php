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
        $path = $this->jigsaw->getSourcePath();
        collect($this->filesystem->directories($path))
            ->filter(function ($folder) {
                foreach ($this->langs as $lang) {
                    if ($folder->getFilename() === $lang) {
                        return true;
                    }
                }
                return false;
            })->each(function ($folder) {
                $this->filesystem->deleteDirectory($folder->getPathName(), false);
            });
        collect($this->filesystem->files($path))
            ->filter(function ($file) {
                foreach ($this->langs as $lang) {
                    if (Str::startsWith($file->getFilename(), $lang . '_')) {
                        return true;
                    }
                }
                return false;
            })->each(function ($file) {
                $this->filesystem->delete($file->getPathName());
            });
    }
}
