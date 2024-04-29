<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\File\Filesystem;
use Mni\FrontYAML\Parser;
use SplFileInfo;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

class PrepareTranslationFiles
{
    private Jigsaw $jigsaw;
    private Filesystem $filesystem;
    private FrontMatterParser $frontMatterParser;
    private array $langs;
    private array $items = [];

    public function handle(Jigsaw $jigsaw)
    {
        $this->filesystem = $jigsaw->getFilesystem();
        $this->jigsaw = $jigsaw;
        $this->langs = $this->jigsaw->getSiteData()->localization->keys()->all();
        $parser = new Parser(
            markdownParser: new MarkdownParser()
        );
        $this->frontMatterParser = new FrontMatterParser($parser);
        $this->handleCollections();
        $this->handlePages();
    }

    private function handlePages(): void
    {
        $path = $this->jigsaw->getSourcePath();
        $self = $this;
        collect($this->filesystem->files($path))
            ->filter(function ($file) {
                if (str_starts_with($file->getFilename(), '_')) {
                    return false;
                }
                if (str_starts_with($file->getRelativePathname(), '_')) {
                    return false;
                }
                if (!in_array($file->getExtension(), ['markdown', 'md', 'mdown'])
                    && !Str::contains($file->getFilename(), '.blade.')
                ) {
                    return false;
                }
                foreach ($this->langs as $lang) {
                    if (Str::startsWith($file->getFilename(), $lang . '_')) {
                        return false;
                    }
                }
                return true;
            })
            ->each(function ($file) use ($path, $self) {
                $self->copyOriginalFilesToTranslatePages($file, $path);
            });
    }

    private function handleCollections(): void
    {
        $collections = $this->jigsaw->getSiteData()->collections;
        $collections->map(function ($collectionSettings, $collectionName) {
            if ($collectionName !== 'posts') {
                return;
            }
            $source = $this->jigsaw->getSourcePath();
            $path = "{$source}/_posts";
            $self = $this;
            collect($this->filesystem->files($path))
                ->filter(function ($file) {
                    foreach ($this->langs as $lang) {
                        if (Str::startsWith($file->getFilename(), $lang . '_')) {
                            return false;
                        }
                    }
                    return true;
                })
                ->each(function ($file) use ($self) {
                    $self->copyOriginalFilesToTranslatePages($file);
                });
            $this->jigsaw->getCollection('page')->collections->posts = collect($this->items);
        });
    }

    public function copyOriginalFilesToTranslatePages(SplFileInfo $file) {
        $content = file_get_contents($file->getPathName());
        $post = $this->frontMatterParser->getFrontMatter($content);
        $isCollection = $this->isInCollectionDirectory($file);
        $this->items[] = $file;
        foreach ($this->langs as $lang) {
            if ($lang === packageDefaultLocale()) {
                continue;
            }
            $translatedName = $file->getFilename();
            if ($post) {
                if (isset($post['title'])) {
                    $translatedTitle = __($this->jigsaw->getSiteData(), $post['title'], $lang);
                    // Don't create translated page if haven't translated title
                    if ($translatedTitle === $post['title']) {
                        continue;
                    }
                    if (!$isCollection) {
                        $translatedName = Str::slug($translatedName);
                        $translatedName = $this->translateFilename($file, $translatedName);
                    }
                }
            }
            if ($isCollection) {
                $translatedName = '_tmp/'.$lang . '_' . $translatedName;
            } else {
                $translatedName = $lang . '/' . $translatedName;
                $path = str_replace(
                    $file->getFilename(),
                    '',
                    $file->getPathName()
                );
            }
            $this->copyToTemporaryTranslatableFile($file, $translatedName);
        }
    }

    private function copyToTemporaryTranslatableFile(SplFileInfo $file, string $translatedName): void
    {
        $destinationPath = str_replace(
            $file->getFilename(),
            $translatedName,
            $file->getPathName()
        );
        $this->filesystem->ensureDirectoryExists(
            pathinfo($destinationPath, PATHINFO_DIRNAME)
        );
        $this->filesystem->copy(
            $file->getPathName(),
            $destinationPath
        );
        $this->items[] = new SplFileInfo($destinationPath);
    }

    private function translateFilename(SplFileInfo $file, $translated): string
    {
        $exploded = explode('.', $file->getFilename());
        $exploded[0] = $translated;
        return implode('.', $exploded);
    }

    private function isInCollectionDirectory($file)
    {
        $relativePath = str_replace(
            $this->jigsaw->getSourcePath() . '/',
            '',
            $file->getPathName()
        );

        return Str::startsWith($relativePath, '_') && $this->hasCollectionNamed($this->getCollectionName($file));
    }

    private function hasCollectionNamed($candidate)
    {
        if ($this->jigsaw->getSiteData()->get('collections')?->get($candidate)) {
            return true;
        }
        return false;
    }

    private function getCollectionName($file)
    {
        $relativePath = str_replace(
            $this->jigsaw->getSourcePath() . '/',
            '',
            $file->getPathName()
        );
        $relativePath = explode('/', $relativePath);
        return substr($relativePath[0], 1);
    }
}
