<?php

declare(strict_types=1);

namespace App\Support\Translation;

final class TranslatedHtmlSanitizer
{
    public static function sanitize(string $translatedHtml): string
    {
        $escapedHtml = htmlspecialchars($translatedHtml, ENT_QUOTES, 'UTF-8', false);

        return preg_replace(
            [
                '/&lt;a href=&quot;(https:\/\/[^\s&]+)&quot;&gt;/',
                '/&lt;\/a&gt;/',
                '/&lt;(\/?)(strong|em)&gt;/',
            ],
            [
                '<a href="$1">',
                '</a>',
                '<$1$2>',
            ],
            $escapedHtml,
        );
    }
}
