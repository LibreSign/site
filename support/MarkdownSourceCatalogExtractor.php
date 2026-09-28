<?php

declare(strict_types=1);

namespace App\Support;

use LibreSign\JigsawLocalization\Extraction\CallbackStringExtractor;
use LibreSign\JigsawLocalization\Extraction\ExtractionPipeline;
use LibreSign\JigsawLocalization\Extraction\TranslationSource;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;

final class MarkdownSourceCatalogExtractor
{
    /**
     * @param list<string> $locales
     * @return array<string, string>
     */
    public function extract(
        string $sourcePath,
        string $sourceLocale,
        FrontMatterParser $parser,
        array $locales,
    ): array {
        $extractor = new CallbackStringExtractor(
            static fn (TranslationSource $source): bool => $source->metadata()['type'] === 'markdown',
            static function (TranslationSource $source) use ($parser): iterable {
                $contents = $source->contents();
                $frontMatter = $parser->getFrontMatter($contents);

                foreach (['title', 'description'] as $field) {
                    $value = $frontMatter[$field] ?? null;

                    if (is_string($value) && $value !== '') {
                        yield $value;
                    }
                }

                $body = $parser->getContent($contents);

                if ($body !== '') {
                    yield $body;
                }
            },
        );

        $pipeline = new ExtractionPipeline($sourceLocale, [$extractor]);

        return $pipeline->catalog(
            $this->sources($sourcePath, $sourceLocale, $locales),
        );
    }

    /**
     * @param list<string> $locales
     * @return iterable<TranslationSource>
     */
    private function sources(
        string $sourcePath,
        string $sourceLocale,
        array $locales,
    ): iterable {
        $sourcePath = rtrim($sourcePath, DIRECTORY_SEPARATOR);

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $sourcePath,
                RecursiveDirectoryIterator::SKIP_DOTS,
            ),
        );

        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $relativePath = ltrim(
                substr($file->getPathname(), strlen($sourcePath)),
                DIRECTORY_SEPARATOR,
            );

            if (! $this->isSourceMarkdown($relativePath, $locales)) {
                continue;
            }

            $contents = file_get_contents($file->getPathname());

            if ($contents === false) {
                continue;
            }

            yield new TranslationSource(
                $sourceLocale,
                str_replace(DIRECTORY_SEPARATOR, '/', $relativePath),
                $contents,
                ['type' => 'markdown'],
            );
        }
    }

    /**
     * @param list<string> $locales
     */
    private function isSourceMarkdown(string $relativePath, array $locales): bool
    {
        $normalizedPath = str_replace('\\', '/', $relativePath);

        if (! preg_match('/\.(?:md|markdown|mdown)$/i', $normalizedPath)) {
            return false;
        }

        $segments = explode('/', $normalizedPath);
        $filename = array_pop($segments);

        if (in_array(\App\Listeners\PrepareTranslationFiles::TEMP_DIRECTORY_NAME, $segments, true)) {
            return false;
        }

        foreach ($locales as $locale) {
            if (in_array($locale, $segments, true) || str_starts_with($filename, $locale.'_')) {
                return false;
            }
        }

        return true;
    }
}
