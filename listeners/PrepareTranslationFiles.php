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
            $items = collect($this->filesystem->files($path))
                ->filter(function ($file) {
                    foreach ($this->langs as $lang) {
                        if (Str::startsWith($file->getFilename(), $lang)) {
                            return false;
                        }
                    }
                    return true;
                })
                ->each(function ($collection) use ($path) {
                    $content = file_get_contents($collection->getPathName());
                    $post = $this->frontMatterParser->getFrontMatter($content);
                    $body = $this->frontMatterParser->getContent($content);
                    $page = $this->jigsaw->getCollection('page');
                    $this->items[] = $collection;
                    foreach ($this->langs as $lang) {
                        $page->updateTranslation($lang, $post['title']);
                        $page->updateTranslation($lang, $post['description']);
                        $page->updateTranslation($lang, $body);
                        $translatedName = __($page, $post['title'], $lang);
                        // Don't create translated page if haven't translated title
                        if ($translatedName === $post['title']) {
                            continue;
                        }
                        $translatedName = $path . '/' . $lang . '-' . Str::slug($translatedName) . '.md';
                        // Create temporary file to be possible create the path of this file
                        $destination = str_replace('/_posts/', "/_posts/{$lang}_", $collection->getPathName());
                        $this->filesystem->copy(
                            $collection->getPathName(),
                            $destination
                        );
                        $this->items[] = new SplFileInfo($destination);
                    }
                });
            // $items = $items->merge($this->items);
            $this->jigsaw->getCollection('page')->collections->posts = collect($this->items);
        });
    }
}
