<?php

declare(strict_types=1);

namespace App\Support\Translation;

final class TranslationTemplateSyntaxValidator
{
    private const BASE_URL_ECHO_PATTERN = '/\{\{\s*\$page->baseUrl\s*\}\}/';
    private const BLADE_DIRECTIVE_PATTERN = '/\B@@?\w+/';

    /**
     * @param array<string, string> $source
     * @param array<string, string> $translation
     * @return list<string>
     */
    public function validate(array $source, array $translation): array
    {
        $errors = [];

        foreach ($translation as $key => $translatedText) {
            if (!array_key_exists($key, $source)) {
                continue;
            }

            $problem = $this->findProblem($source[$key], $translatedText);
            if ($problem !== null) {
                $errors[] = sprintf('%s in translation of "%s".', $problem, strtok($key, "\n"));
            }
        }

        return $errors;
    }

    private function findProblem(string $sourceText, string $translatedText): ?string
    {
        if (str_contains($translatedText, '<?')) {
            return 'PHP tag';
        }

        if (preg_match('/<\/?x[-:]/', $translatedText) === 1) {
            return 'Blade component tag';
        }

        if (str_contains($translatedText, '{!!')) {
            return 'Unescaped Blade echo';
        }

        if (str_contains(preg_replace(self::BASE_URL_ECHO_PATTERN, '', $translatedText), '{{')) {
            return 'Blade echo other than {{ $page->baseUrl }}';
        }

        if (preg_match_all(self::BASE_URL_ECHO_PATTERN, $translatedText) !== preg_match_all(self::BASE_URL_ECHO_PATTERN, $sourceText)) {
            return 'Base URL echo count differs from source';
        }

        $unexpectedDirectives = array_diff($this->bladeDirectives($translatedText), $this->bladeDirectives($sourceText));
        if ($unexpectedDirectives !== []) {
            return sprintf('Blade directive %s', implode(', ', array_unique($unexpectedDirectives)));
        }

        return null;
    }

    /**
     * @return list<string>
     */
    private function bladeDirectives(string $text): array
    {
        preg_match_all(self::BLADE_DIRECTIVE_PATTERN, $text, $matches);

        return $matches[0];
    }
}
