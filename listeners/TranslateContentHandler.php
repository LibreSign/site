<?php

namespace App\Listeners;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\File\InputFile;
use TightenCo\Jigsaw\PageData;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;

class TranslateContentHandler
{
    private InputFile $file;
    private PageData $pageData;
    private Collection $handlers;
    private string $translated = '';
    private string $languageCode = '';
    private array $translatableHeaders = [
        'title',
        'description',
    ];
    public function __construct(
        private FrontMatterParser $parser,
        $handlers,
    )
    {
        $this->handlers = collect($handlers);
    }

    public function shouldHandle($file)
    {
        return true;
    }

    public function shouldTranslate()
    {
        return in_array($this->file->getExtension(), ['markdown', 'md', 'mdown'])
            || Str::contains($this->file->getFilename(), '.blade.');
    }

    public function handle($file, $pageData)
    {
        $this->file = $file;
        $this->pageData = $pageData;
        $this->translate();
        $handler = $this->handlers->first(function ($handler) use ($file) {
            return $handler->shouldHandle($file);
        });
        return $handler->handle($file, $pageData);
    }

    private function translate()
    {
        if (!$this->shouldTranslate()) {
            return;
        }

        $this->languageCode = $this->getLanguageCode();
        if (!$this->languageCode) {
            return;
        }
        $langs = $this->pageData->page->localization->keys()->all();
        if (!in_array($this->languageCode, $langs)) {
            return;
        }
        $this->translated = $this->file->getContents();
        $this->translateHeaders();
        $this->translateContent();
        file_put_contents($this->file->getPathname(), $this->translated);
    }

    private function translateContent(): void
    {
        $content = $this->parser->getContent($this->translated);
        $this->translated = str_replace(
            $content,
            $this->pageData->page->t($content, $this->languageCode),
            $this->translated
        );
    }

    private function translateHeaders(): void
    {
        $header = $this->parser->getFrontMatter($this->translated);
        foreach ($this->translatableHeaders as $headerName) {
            if (!isset($header[$headerName])) {
                continue;
            }
            $this->translated = str_replace(
                $header[$headerName] . "\n",
                $this->pageData->page->t($header[$headerName], $this->languageCode) . "\n",
                $this->translated
            );
        }
    }

    private function getLanguageCode(): string
    {
        $filename = $this->file->getFilenameWithoutExtension();
        /**
         * - [a-z]{2,3} language code
         * - [A-Z]{2} region code
         *
         * @var string $locale_regex
         */
        $locale_regex = '/^(?<locale>(?:[a-z]{2,3}-[A-Z]{2})|(?:[a-z]{2,3}))(?:[^a-zA-Z]|$)/';
        preg_match($locale_regex, $filename, $matches);
        return $matches['locale'] ?? '';
    }
}
