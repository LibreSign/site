<?php

declare(strict_types=1);

namespace App\Support\Pricing;

use Carbon\Carbon;

final class WooCommerceProductTransformer
{
    public function formatWooCommercePrice(array $prices, ?string $amount = null): ?string
    {
        if ($amount === null || $amount === '') {
            return null;
        }

        $minorUnit = (int) ($prices['currency_minor_unit'] ?? 2);
        $divisor = $minorUnit > 0 ? 10 ** $minorUnit : 1;
        $value = ((int) $amount) / $divisor;

        return trim(
            ($prices['currency_prefix'] ?? '')
            . number_format(
                $value,
                $minorUnit,
                $prices['currency_decimal_separator'] ?? ',',
                $prices['currency_thousand_separator'] ?? '.'
            )
            . ($prices['currency_suffix'] ?? '')
        );
    }

    public function normalizeWooCommerceAttribute(array $attribute): ?array
    {
        $values = [];

        foreach ($attribute['terms'] ?? [] as $term) {
            $values[] = is_array($term) ? ($term['name'] ?? null) : null;
        }

        if (empty(array_filter($values))) {
            foreach ($attribute['options'] ?? [] as $option) {
                if (is_array($option)) {
                    $values[] = $option['name'] ?? null;
                    continue;
                }

                $values[] = is_string($option) ? $option : null;
            }
        }

        $values = array_values(array_filter(array_map(
            static fn ($value) => trim((string) $value),
            $values
        ), static fn ($value) => $value !== ''));

        if (empty($values)) {
            return null;
        }

        return [
            'name' => $attribute['name'] ?? '',
            'values' => $values,
            'visible' => $attribute['visible'] ?? true,
        ];
    }

    public function parsePricingCardColors(array $attributes): array
    {
        $colorAttribute = collect($attributes)->first(function (array $attribute) {
            return in_array(
                $this->normalizeAttributeKey($attribute['name'] ?? ''),
                ['nextcloud_pricing_card_colors', 'pricing_card_colors'],
                true
            );
        });

        if (empty($colorAttribute['values'])) {
            return [];
        }

        $colors = [];

        foreach ($colorAttribute['values'] as $rawValue) {
            [$rawKey, $rawColor] = array_pad(explode(':', (string) $rawValue, 2), 2, null);
            $colorKey = $this->normalizeAttributeKey($rawKey);
            $colorValue = trim((string) $rawColor);

            if ($colorKey === '' || $colorValue === '') {
                continue;
            }

            if ($colorValue[0] !== '#') {
                $colorValue = '#' . ltrim($colorValue, '#');
            }

            if (!preg_match('/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?([0-9a-fA-F]{2})?$/', $colorValue)) {
                continue;
            }

            $colors[$colorKey] = strtoupper($colorValue);
        }

        return $colors;
    }

    public function mapProduct(
        array $fromApi,
        array $productDetails,
        array $authenticatedProductDetails,
        array $wordPressLanguages,
    ): array {
        $rawLanguage = isset($fromApi['lang']) && is_string($fromApi['lang'])
            ? $fromApi['lang']
            : null;
        $translations = array_filter(
            $fromApi['translations'] ?? [],
            static fn ($translationId) => !empty($translationId)
        );
        $translationIds = array_values($translations);
        sort($translationIds);
        $translationGroup = implode('-', $translationIds ?: [$fromApi['id']]);

        $currentLang = $rawLanguage === null
            ? false
            : current(array_filter(
                $wordPressLanguages,
                static fn ($language) => $language->slug === $rawLanguage
            ));
        if ($currentLang === false) {
            $currentLang = null;
        }

        $prices = $productDetails['prices'] ?? [];
        $priceRange = $prices['price_range'] ?? null;
        $priceAmount = $this->formatWooCommercePrice(
            $prices,
            $priceRange['min_amount'] ?? $prices['price'] ?? null
        );

        $attributeSource = !empty($authenticatedProductDetails['attributes'])
            ? $authenticatedProductDetails['attributes']
            : ($productDetails['attributes'] ?? []);

        $attributes = collect($attributeSource)
            ->map(fn (array $attribute) => $this->normalizeWooCommerceAttribute($attribute))
            ->filter()
            ->values()
            ->all();

        return [
            'id' => $fromApi['id'],
            'translationGroup' => $translationGroup,
            'translations' => $translations,
            'title' => $productDetails['name'] ?? $fromApi['title']['rendered'],
            'slug' => $fromApi['slug'],
            'date' => Carbon::parse($fromApi['date'])->timestamp,
            'lang' => $currentLang?->w3c ?? $rawLanguage,
            'langSlug' => $currentLang?->slug ?? $rawLanguage,
            'description' => !empty($productDetails['short_description'])
                ? $productDetails['short_description']
                : ($productDetails['description'] ?? ''),
            'permalink' => $productDetails['permalink'] ?? $fromApi['link'],
            'buttonLabel' => $productDetails['add_to_cart']['single_text']
                ?? $productDetails['add_to_cart']['text']
                ?? 'View product',
            'price' => $priceAmount,
            'hasPriceRange' => !empty($priceRange['min_amount']),
            'productType' => $productDetails['type'] ?? null,
            'isPurchasable' => $productDetails['is_purchasable'] ?? false,
            'hasOptions' => $productDetails['has_options'] ?? false,
            'attributes' => $attributes,
            'pricingCardColors' => $this->parsePricingCardColors($attributes),
        ];
    }

    private function normalizeAttributeKey(?string $attributeName): string
    {
        $attributeName = strtolower(trim((string) $attributeName));

        return trim((string) preg_replace('/[^a-z0-9]+/', '_', $attributeName), '_');
    }
}
