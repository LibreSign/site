<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

/**
 * Tracks all translatable strings encountered during a Jigsaw build.
 *
 * During normal builds this class only collects strings in memory and never
 * writes to disk, keeping the lang/ directory clean for Weblate to manage.
 *
 * When JIGSAW_EXTRACT_STRINGS=1 is set (extraction mode), the afterBuild
 * listener PersistExtractedStrings calls persistExtractedStrings() to sync
 * lang/{defaultLocale}/main.json with the current set of source strings.
 */
class AddNewTranslation
{
    private static array $encounteredStrings = [];

    public function handle(Jigsaw $jigsaw): void
    {
        $self = $this;
        $jigsaw->getSiteData()->macro('addNewTranslation', function (string $currentLanguage, string $text) use ($self): void {
            $self->track($text);
        });
    }

    public function track(string $text): void
    {
        self::$encounteredStrings[$text] = $text;
    }

    /**
     * Persist the collected strings to lang/{defaultLocale}/main.json.
     *
     * New strings are added with the source text as the default value.
     * Strings no longer present in the templates are removed.
     * Existing translations for the default locale are preserved.
     *
     * Only runs when JIGSAW_EXTRACT_STRINGS env var is set to a truthy value.
     */
    public function persistExtractedStrings(): void
    {
        if (!self::isExtractionMode()) {
            return;
        }

        $defaultLocale = packageDefaultLocale();
        $translationFile = 'lang/' . $defaultLocale . '/main.json';

        $existing = [];
        if (file_exists($translationFile)) {
            $existing = json_decode(file_get_contents($translationFile), true) ?? [];
        }

        // Rebuild the source file: keep only strings still in use, add new ones.
        $updated = [];
        foreach (self::$encounteredStrings as $text => $_) {
            $updated[$text] = $existing[$text] ?? $text;
        }
        ksort($updated);

        if (!is_dir('lang/' . $defaultLocale)) {
            mkdir('lang/' . $defaultLocale, 0755, true);
        }

        file_put_contents(
            $translationFile,
            json_encode($updated, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    public static function isExtractionMode(): bool
    {
        return !empty(getenv('JIGSAW_EXTRACT_STRINGS'));
    }
}
