<?php

namespace App\Listeners;

use TightenCo\Jigsaw\File\Filesystem;
use TightenCo\Jigsaw\Jigsaw;

class RemoveTranslationFiles
{
    private Jigsaw $jigsaw;
    private Filesystem $filesystem;
    private array $langs;

    public function handle(Jigsaw $jigsaw): void
    {
        $this->filesystem = $jigsaw->getFilesystem();
        $this->jigsaw = $jigsaw;
        $this->langs = $this->jigsaw->getSiteData()->localization->keys()->all();
        $path = $this->jigsaw->getSourcePath();

        $this->removeTranslatedDirectories($path);
        $this->removeTranslatedFiles($path);
    }

    private function removeTranslatedDirectories(string $sourcePath): void
    {
        $directoriesToRemove = [];

        // Remove only top-level locale folders generated for translated pages.
        foreach ($this->langs as $lang) {
            $localeDirectory = rtrim($sourcePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $lang;
            if (is_dir($localeDirectory)) {
                $directoriesToRemove[] = $localeDirectory;
            }
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $item) {
            if (!$item->isDir()) {
                continue;
            }

            $directoryName = $item->getFilename();
            if ($directoryName === '_tmp') {
                $directoriesToRemove[] = $item->getPathname();
            }
        }

        foreach ($directoriesToRemove as $directoryPath) {
            if (is_dir($directoryPath)) {
                $this->filesystem->deleteDirectory($directoryPath, false);
            }
        }
    }

    private function removeTranslatedFiles(string $sourcePath): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $item) {
            if (!$item->isFile()) {
                continue;
            }

            if (!str_contains($item->getPathname(), DIRECTORY_SEPARATOR . '_tmp' . DIRECTORY_SEPARATOR)) {
                continue;
            }

            $filename = $item->getFilename();
            foreach ($this->langs as $lang) {
                if (str_starts_with($filename, $lang . '_')) {
                    $this->filesystem->delete($item->getPathname());
                    break;
                }
            }
        }
    }
}
