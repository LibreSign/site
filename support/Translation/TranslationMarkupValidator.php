<?php

declare(strict_types=1);

namespace App\Support\Translation;

final class TranslationMarkupValidator
{
    private const HTML_TAG_PATTERN = '/<\/?([A-Za-z][\w-]*)((?:[^>"\']|"[^"]*"|\'[^\']*\')*)>/';
    private const HTML_ATTRIBUTE_PATTERN = '/([A-Za-z_:@][-\w:.]*)\s*(?:=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+))?/';

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

            $sourceMarkup = $this->markup($source[$key]);
            $translatedMarkup = $this->markup($translatedText);
            if ($sourceMarkup === $translatedMarkup) {
                continue;
            }

            $errors[] = sprintf(
                'HTML markup mismatch in translation of "%s": expected [%s], got [%s].',
                strtok($key, "\n"),
                implode(', ', $sourceMarkup),
                implode(', ', $translatedMarkup),
            );
        }

        return $errors;
    }

    /**
     * @return list<string>
     */
    private function markup(string $text): array
    {
        $markup = [];
        preg_match_all(self::HTML_TAG_PATTERN, $text, $tags, PREG_SET_ORDER);
        foreach ($tags as [, $tagName, $attributes]) {
            $tagName = strtolower($tagName);
            $markup[] = $tagName;
            preg_match_all(self::HTML_ATTRIBUTE_PATTERN, $attributes, $attributeMatches);
            foreach ($attributeMatches[1] as $attributeName) {
                $markup[] = $tagName . '[' . strtolower($attributeName) . ']';
            }
        }

        $markup = array_values(array_unique($markup));
        sort($markup);

        return $markup;
    }
}
