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
            $items = collect($this->filesystem->files($path))
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
            // $items = $items->merge($this->items);
            $this->jigsaw->getCollection('page')->collections->posts = collect($this->items);
        });
    }

    public function copyOriginalFilesToTranslatePages(SplFileInfo $file) {
        $content = file_get_contents($file->getPathName());
        $post = $this->frontMatterParser->getFrontMatter($content);
        $body = $this->frontMatterParser->getContent($content);
        $page = $this->jigsaw->getCollection('page');
        $this->items[] = $file;
        foreach ($this->langs as $lang) {
            $page->updateTranslation($lang, $post['title']);
            $page->updateTranslation($lang, $post['description']);
            $page->updateTranslation($lang, $body);
            $translatedName = __($page, $post['title'], $lang);
            // Don't create translated page if haven't translated title
            if ($translatedName === $post['title']) {
                continue;
            }
            $translatedName = $lang . '_' . Str::slug($translatedName);
            // Create temporary file to be possible create the path of this file
            $destination = str_replace(
                $file->getFilename(),
                $this->translateFilename($file, $translatedName),
                $file->getPathName()
            );
            $this->filesystem->copy(
                $file->getPathName(),
                $destination
            );
            $this->items[] = new SplFileInfo($destination);
        }
    }

    private function translateFilename(SplFileInfo $file, $translated): string
    {
        if (in_array($file->getExtension(), ['markdown', 'md', 'mdown'])) {
            return $translated . $file->getExtension();
        }
        $exploded = explode('.blade.', $file->getFilename());
        $exploded[0] = $translated;
        return implode('.blade.', $exploded);
    }
}
