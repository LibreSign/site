<?php

namespace App\Listeners;

use LibreSign\JigsawLocalization\Catalog\JsonTranslationCatalog;
use LibreSign\JigsawLocalization\Catalog\SourceStringCollector;
use LibreSign\JigsawLocalization\Catalog\TranslationCatalogSynchronizer;
use TightenCo\Jigsaw\Jigsaw;

/**
 * Connects the site's Jigsaw translation macro to the reusable localization
 * package and persists the canonical source catalog only during extraction.
 */
class AddNewTranslation
{
    private static ?SourceStringCollector $collector = null;

    public function handle(Jigsaw $jigsaw): void
    {
        $collector = new SourceStringCollector(packageDefaultLocale());
        self::$collector = $collector;

        $jigsaw->getSiteData()->macro(
            'addNewTranslation',
            static function (string $currentLanguage, string $text) use ($collector): void {
                $collector->collect($currentLanguage, $text);
            }
        );
    }

    public function persistExtractedStrings(): void
    {
        if (! self::isExtractionMode() || self::$collector === null) {
            return;
        }

        $defaultLocale = packageDefaultLocale();
        $catalog = new JsonTranslationCatalog(
            'lang/'.$defaultLocale.'/main.json'
        );
        $synchronizer = new TranslationCatalogSynchronizer();

        $catalog->write(
            $synchronizer->source(array_keys(self::$collector->all()))
        );
    }

    public static function isExtractionMode(): bool
    {
        return ! empty(getenv('JIGSAW_EXTRACT_STRINGS'));
    }
}
