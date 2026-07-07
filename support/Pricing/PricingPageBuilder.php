<?php

declare(strict_types=1);

namespace App\Support\Pricing;

use Illuminate\Support\Collection;

final class PricingPageBuilder
{
    public function build(iterable $products, ?string $currentLocale, ?string $defaultLocale): array
    {
        $productGroups = collect($products)
            ->groupBy(fn ($product) => $product->translationGroup ?? (string) ($product->id ?? $product->slug ?? ''))
            ->map(fn ($group) => collect($group)->values());

        $orderedProductEntries = $productGroups
            ->map(fn (Collection $group) => $this->buildProductEntry($group, $currentLocale, $defaultLocale))
            ->filter()
            ->sort(fn (array $leftEntry, array $rightEntry) => $this->compareProductEntries($leftEntry, $rightEntry))
            ->values();

        $productEntries = $orderedProductEntries
            ->map(function (array $productEntry, int $index) use ($orderedProductEntries) {
                $previousProductEntry = $index > 0 ? $orderedProductEntries->get($index - 1) : null;
                $currentFeatureValues = $this->flattenFeatureValues($productEntry['displayAttributes'] ?? []);
                $previousFeatureValues = $previousProductEntry
                    ? $this->flattenFeatureValues($previousProductEntry['displayAttributes'] ?? [])
                    : [];

                return [
                    'product' => $productEntry['product'],
                    'displayAttributes' => $productEntry['displayAttributes'],
                    'detailAttributes' => $this->filterDetailAttributes($productEntry['displayAttributes']),
                    'cardHighlights' => $this->buildCardHighlights(
                        $currentFeatureValues,
                        $previousFeatureValues,
                        $previousProductEntry['product']->title ?? null
                    ),
                ];
            })
            ->values();

        [$comparisonProducts, $comparisonFeatureGroups, $detailRows] = $this->buildComparisonData($productEntries);

        return [
            'productEntries' => $productEntries,
            'comparisonProducts' => $comparisonProducts,
            'comparisonFeatureGroups' => $comparisonFeatureGroups,
            'detailRows' => $detailRows,
        ];
    }

    private function buildProductEntry(
        Collection $group,
        ?string $currentLocale,
        ?string $defaultLocale,
    ): ?array {
        $selectedProduct = $this->selectLocalizedProduct($group, $currentLocale, $defaultLocale);

        if (empty($selectedProduct)) {
            return null;
        }

        $displayAttributes = $this->mergeDisplayAttributes(
            $this->filterFriendlyAttributes($selectedProduct->attributes ?? []),
            $this->filterFriendlyAttributes(
                $this->firstMatchingAttributes($group, $currentLocale)?->attributes ?? []
            ),
            $this->filterFriendlyAttributes(
                $this->firstMatchingAttributes($group, $defaultLocale)?->attributes ?? []
            ),
            $this->filterFriendlyAttributes(
                $group->first(fn ($product) => !empty($this->filterFriendlyAttributes($product->attributes ?? [])))?->attributes ?? []
            ),
        );

        $storageAttribute = $this->resolveGroupAttribute(
            $group,
            ['storage', 'storage_available', 'available_storage', 'nextcloud_storage'],
            $currentLocale,
            $defaultLocale,
        );

        return [
            'product' => $selectedProduct,
            'displayAttributes' => $displayAttributes,
            'sortMetrics' => [
                'storageCapacity' => $this->parseStorageCapacity($storageAttribute),
                'featureCount' => count($this->flattenFeatureValues($displayAttributes)),
                'date' => $selectedProduct->date ?? 0,
            ],
        ];
    }

    private function buildComparisonData(Collection $productEntries): array
    {
        $comparisonProducts = [];
        $detailAttributeDefinitions = [];

        foreach ($productEntries as $productEntry) {
            $selectedProduct = $productEntry['product'];
            $displayAttributes = $productEntry['displayAttributes'] ?? [];
            $featureGroups = [];
            $featureAttributeNamesToHide = $this->collectFeatureAttributeNames($displayAttributes);
            $detailValues = [];

            foreach ($this->featureGroupDefinitions() as $featureGroupDefinition) {
                $featureGroup = $this->buildFeatureGroup($displayAttributes, $featureGroupDefinition);

                if ($featureGroup === null) {
                    continue;
                }

                $featureGroups[$featureGroupDefinition['key']] = [
                    'label' => $featureGroup['label'],
                    'values' => $featureGroup['values'],
                    'lookup' => collect($featureGroup['values'])
                        ->mapWithKeys(function ($featureValue) {
                            $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

                            return $normalizedFeatureValue === '' ? [] : [$normalizedFeatureValue => true];
                        })
                        ->all(),
                ];
            }

            foreach ($displayAttributes as $attribute) {
                $attributeName = $attribute['name'] ?? '';
                $normalizedAttributeName = $this->normalizeAttributeName($attributeName);
                $attributeValues = $this->extractAttributeValues($attribute);

                if ($normalizedAttributeName === '' || empty($attributeValues)) {
                    continue;
                }

                if (in_array($normalizedAttributeName, $featureAttributeNamesToHide, true)) {
                    continue;
                }

                if (!array_key_exists($normalizedAttributeName, $detailAttributeDefinitions)) {
                    $detailAttributeDefinitions[$normalizedAttributeName] = $attributeName;
                }

                $detailValues[$normalizedAttributeName] = $attributeValues;
            }

            $comparisonProducts[] = [
                'title' => $selectedProduct->title ?? '',
                'permalink' => $selectedProduct->permalink ?? '#',
                'pricingCardColors' => (array) ($selectedProduct->pricingCardColors ?? []),
                'featureGroups' => $featureGroups,
                'detailValues' => $detailValues,
            ];
        }

        $comparisonProducts = collect($comparisonProducts);

        $comparisonFeatureGroups = collect($this->featureGroupDefinitions())
            ->map(function (array $featureGroupDefinition) use ($comparisonProducts) {
                $featureGroupKey = $featureGroupDefinition['key'];
                $featureOrder = [];

                foreach ($comparisonProducts as $comparisonProduct) {
                    foreach ($comparisonProduct['featureGroups'][$featureGroupKey]['values'] ?? [] as $featureValue) {
                        $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

                        if ($normalizedFeatureValue === '' || array_key_exists($normalizedFeatureValue, $featureOrder)) {
                            continue;
                        }

                        $featureOrder[$normalizedFeatureValue] = $featureValue;
                    }
                }

                if (empty($featureOrder)) {
                    return null;
                }

                if (($featureGroupDefinition['comparisonMode'] ?? 'all') === 'differentials' && $comparisonProducts->isNotEmpty()) {
                    $featureOrder = collect($featureOrder)
                        ->filter(function ($featureLabel, $featureKey) use ($comparisonProducts, $featureGroupKey) {
                            $includedCount = $comparisonProducts
                                ->filter(fn ($comparisonProduct) => !empty($comparisonProduct['featureGroups'][$featureGroupKey]['lookup'][$featureKey]))
                                ->count();

                            return $includedCount > 0 && $includedCount < $comparisonProducts->count();
                        })
                        ->all();
                }

                if (empty($featureOrder)) {
                    return null;
                }

                return [
                    'key' => $featureGroupKey,
                    'label' => $featureGroupDefinition['label'],
                    'rows' => collect($featureOrder)
                        ->map(function ($featureLabel, $featureKey) use ($comparisonProducts, $featureGroupKey) {
                            return [
                                'label' => $featureLabel,
                                'products' => $comparisonProducts->map(fn ($comparisonProduct) => [
                                    'title' => $comparisonProduct['title'],
                                    'included' => !empty($comparisonProduct['featureGroups'][$featureGroupKey]['lookup'][$featureKey]),
                                ]),
                            ];
                        })
                        ->values(),
                ];
            })
            ->filter()
            ->values();

        $detailRows = collect($detailAttributeDefinitions)
            ->map(function ($attributeLabel, $attributeKey) use ($comparisonProducts) {
                $products = $comparisonProducts->map(fn ($product) => [
                    'title' => $product['title'],
                    'values' => $product['detailValues'][$attributeKey] ?? [],
                ]);

                return [
                    'label' => $attributeLabel,
                    'products' => $products,
                ];
            })
            ->filter(fn ($row) => $row['products']->contains(fn ($product) => !empty($product['values'])))
            ->values();

        return [$comparisonProducts, $comparisonFeatureGroups, $detailRows];
    }

    private function filterDetailAttributes(array $attributes): array
    {
        $hiddenAttributeNames = $this->collectFeatureAttributeNames($attributes);

        return array_values(array_filter($attributes, function ($attribute) use ($hiddenAttributeNames) {
            return !in_array($this->normalizeAttributeName($attribute['name'] ?? ''), $hiddenAttributeNames, true);
        }));
    }

    private function compareProductEntries(array $leftEntry, array $rightEntry): int
    {
        $leftStorageCapacity = $leftEntry['sortMetrics']['storageCapacity'] ?? null;
        $rightStorageCapacity = $rightEntry['sortMetrics']['storageCapacity'] ?? null;

        if ($leftStorageCapacity !== null && $rightStorageCapacity !== null && $leftStorageCapacity !== $rightStorageCapacity) {
            return $leftStorageCapacity <=> $rightStorageCapacity;
        }

        if ($leftStorageCapacity !== null xor $rightStorageCapacity !== null) {
            return $leftStorageCapacity === null ? 1 : -1;
        }

        $leftFeatureCount = $leftEntry['sortMetrics']['featureCount'] ?? 0;
        $rightFeatureCount = $rightEntry['sortMetrics']['featureCount'] ?? 0;

        if ($leftFeatureCount !== $rightFeatureCount) {
            return $leftFeatureCount <=> $rightFeatureCount;
        }

        $leftDate = $leftEntry['sortMetrics']['date'] ?? 0;
        $rightDate = $rightEntry['sortMetrics']['date'] ?? 0;

        if ($leftDate !== $rightDate) {
            return $leftDate <=> $rightDate;
        }

        return strcasecmp((string) ($leftEntry['product']->title ?? ''), (string) ($rightEntry['product']->title ?? ''));
    }

    private function selectLocalizedProduct(Collection $group, ?string $currentLocale, ?string $defaultLocale)
    {
        return $this->bestMatchingProduct($group, $currentLocale)
            ?? $this->bestMatchingProduct($group, $defaultLocale)
            ?? $group->first();
    }

    private function firstMatchingAttributes(Collection $group, ?string $preferredLocale)
    {
        return $this->bestMatchingProduct(
            $group,
            $preferredLocale,
            fn ($product) => !empty($this->filterFriendlyAttributes($product->attributes ?? []))
        );
    }

    private function normalizeLocale(?string $locale): ?string
    {
        if (empty($locale)) {
            return null;
        }

        return strtolower(str_replace('_', '-', trim((string) $locale)));
    }

    private function localeBase(?string $locale): ?string
    {
        $normalizedLocale = $this->normalizeLocale($locale);

        if ($normalizedLocale === null) {
            return null;
        }

        return explode('-', $normalizedLocale)[0] ?: null;
    }

    private function normalizeAttributeName(?string $attributeName): string
    {
        $attributeName = strtolower(trim((string) $attributeName));

        return trim((string) preg_replace('/[^a-z0-9]+/', '_', $attributeName), '_');
    }

    private function bestMatchingProduct(Collection $group, ?string $preferredLocale, ?callable $predicate = null)
    {
        $predicate ??= static fn ($product) => true;
        $bestProduct = null;
        $bestScore = 0;

        foreach ($group as $product) {
            if (!$predicate($product)) {
                continue;
            }

            $score = $this->localeMatchScore($product, $preferredLocale);

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestProduct = $product;
            }
        }

        return $bestProduct;
    }

    private function localeMatchScore($product, ?string $preferredLocale): int
    {
        $normalizedPreferredLocale = $this->normalizeLocale($preferredLocale);
        $preferredBaseLocale = $this->localeBase($preferredLocale);

        if ($normalizedPreferredLocale === null && $preferredBaseLocale === null) {
            return 0;
        }

        $productLocales = array_values(array_unique(array_filter([
            $this->normalizeLocale($product->lang ?? null),
            $this->normalizeLocale($product->langSlug ?? null),
        ])));

        if ($normalizedPreferredLocale !== null && in_array($normalizedPreferredLocale, $productLocales, true)) {
            return 20;
        }

        $productBaseLocales = array_values(array_unique(array_filter(array_map(
            fn ($locale) => $this->localeBase($locale),
            $productLocales,
        ))));

        if ($preferredBaseLocale !== null && in_array($preferredBaseLocale, $productBaseLocales, true)) {
            return 10;
        }

        return 0;
    }

    private function filterFriendlyAttributes(array $attributes): array
    {
        return array_values(array_filter($attributes, function ($attribute) {
            $attributeName = $this->normalizeAttributeName($attribute['name'] ?? '');

            return $attributeName !== '' && !str_starts_with($attributeName, 'nextcloud_');
        }));
    }

    private function findAttributeByNames($product, array $candidateNames): ?array
    {
        $attributes = collect($product->attributes ?? []);
        $friendlyCandidateNames = array_values(array_filter(
            $candidateNames,
            fn ($candidateName) => !str_starts_with($candidateName, 'nextcloud_')
        ));

        $friendlyMatch = $attributes->first(function ($attribute) use ($friendlyCandidateNames) {
            return in_array(
                $this->normalizeAttributeName($attribute['name'] ?? ''),
                $friendlyCandidateNames,
                true
            );
        });

        if (!empty($friendlyMatch['values'])) {
            return $friendlyMatch;
        }

        $fallbackMatch = $attributes->first(function ($attribute) use ($candidateNames) {
            return in_array(
                $this->normalizeAttributeName($attribute['name'] ?? ''),
                $candidateNames,
                true
            );
        });

        return !empty($fallbackMatch['values']) ? $fallbackMatch : null;
    }

    private function resolveGroupAttribute(
        Collection $group,
        array $candidateNames,
        ?string $currentLocale,
        ?string $defaultLocale,
    ): ?array {
        $hasMatchingAttributes = fn ($product) => !empty($this->findAttributeByNames($product, $candidateNames)['values'] ?? []);

        $attributeSource = $this->bestMatchingProduct($group, $currentLocale, $hasMatchingAttributes)
            ?? $this->bestMatchingProduct($group, $defaultLocale, $hasMatchingAttributes)
            ?? $group->first(fn ($product) => !empty($this->findAttributeByNames($product, $candidateNames)['values'] ?? []));

        return $attributeSource ? $this->findAttributeByNames($attributeSource, $candidateNames) : null;
    }

    private function parseStorageCapacity(?array $attribute): ?float
    {
        $storageValue = $attribute['values'][0] ?? null;

        if (empty($storageValue) || !preg_match('/([\d.,]+)\s*([kmgtp]?b)/i', (string) $storageValue, $matches)) {
            return null;
        }

        $normalizedValue = str_replace(['.', ','], ['', '.'], $matches[1]);
        $numericValue = (float) $normalizedValue;
        $unit = strtoupper($matches[2]);
        $multipliers = [
            'B' => 1,
            'KB' => 1024,
            'MB' => 1024 ** 2,
            'GB' => 1024 ** 3,
            'TB' => 1024 ** 4,
            'PB' => 1024 ** 5,
        ];

        return isset($multipliers[$unit]) ? $numericValue * $multipliers[$unit] : $numericValue;
    }

    private function normalizeComparisonValue(?string $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        return function_exists('mb_strtolower')
            ? mb_strtolower($value, 'UTF-8')
            : strtolower($value);
    }

    private function extractAttributeValues(?array $attribute): array
    {
        return array_values(array_filter(array_map(static function ($value) {
            return trim((string) $value);
        }, $attribute['values'] ?? []), static fn ($value) => $value !== ''));
    }

    private function mergeDisplayAttributes(array ...$attributeSets): array
    {
        $mergedAttributes = [];

        foreach ($attributeSets as $attributes) {
            foreach ($attributes as $attribute) {
                $normalizedAttributeName = $this->normalizeAttributeName($attribute['name'] ?? '');
                $attributeValues = $this->extractAttributeValues($attribute);

                if ($normalizedAttributeName === '' || empty($attributeValues) || array_key_exists($normalizedAttributeName, $mergedAttributes)) {
                    continue;
                }

                $mergedAttributes[$normalizedAttributeName] = [
                    'name' => $attribute['name'] ?? '',
                    'values' => $attributeValues,
                ];
            }
        }

        return array_values($mergedAttributes);
    }

    private function featureGroupDefinitions(): array
    {
        return [
            [
                'key' => 'libresign_features',
                'candidateNames' => ['libresign_features', 'libresign_feature', 'libresign_capabilities'],
                'label' => 'LibreSign features',
                'comparisonMode' => 'all',
            ],
            [
                'key' => 'plan_apps',
                'candidateNames' => ['available_features', 'available_apps', 'apps_available', 'nextcloud_apps'],
                'label' => 'Apps and plan extras',
                'comparisonMode' => 'differentials',
            ],
        ];
    }

    private function findDisplayAttribute(array $attributes, array $candidateNames): ?array
    {
        foreach ($attributes as $attribute) {
            if (in_array($this->normalizeAttributeName($attribute['name'] ?? ''), $candidateNames, true)) {
                return $attribute;
            }
        }

        return null;
    }

    private function buildFeatureGroup(array $attributes, array $featureGroupDefinition): ?array
    {
        $attribute = $this->findDisplayAttribute($attributes, $featureGroupDefinition['candidateNames'] ?? []);
        $values = $this->extractAttributeValues($attribute);

        if (empty($values)) {
            return null;
        }

        return [
            'key' => $featureGroupDefinition['key'],
            'attributeName' => $attribute['name'] ?? ($featureGroupDefinition['label'] ?? 'Features'),
            'label' => $featureGroupDefinition['label'] ?? ($attribute['name'] ?? 'Features'),
            'values' => $values,
        ];
    }

    private function collectFeatureAttributeNames(array $attributes): array
    {
        $attributeNames = [];

        foreach ($this->featureGroupDefinitions() as $featureGroupDefinition) {
            $attribute = $this->findDisplayAttribute($attributes, $featureGroupDefinition['candidateNames'] ?? []);
            $normalizedAttributeName = $this->normalizeAttributeName($attribute['name'] ?? '');

            if ($normalizedAttributeName !== '') {
                $attributeNames[$normalizedAttributeName] = true;
            }
        }

        return array_keys($attributeNames);
    }

    private function flattenFeatureValues(array $attributes): array
    {
        $featureValues = [];

        foreach ($this->featureGroupDefinitions() as $featureGroupDefinition) {
            $featureGroup = $this->buildFeatureGroup($attributes, $featureGroupDefinition);

            if ($featureGroup === null) {
                continue;
            }

            foreach ($featureGroup['values'] as $featureValue) {
                $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

                if ($normalizedFeatureValue === '' || array_key_exists($normalizedFeatureValue, $featureValues)) {
                    continue;
                }

                $featureValues[$normalizedFeatureValue] = $featureValue;
            }
        }

        return array_values($featureValues);
    }

    private function buildCardHighlights(
        array $currentFeatureValues,
        array $previousFeatureValues = [],
        ?string $previousProductTitle = null,
    ): array {
        $currentFeatureLookup = [];
        $deduplicatedCurrentValues = [];

        foreach ($currentFeatureValues as $featureValue) {
            $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

            if ($normalizedFeatureValue === '' || array_key_exists($normalizedFeatureValue, $currentFeatureLookup)) {
                continue;
            }

            $currentFeatureLookup[$normalizedFeatureValue] = true;
            $deduplicatedCurrentValues[] = $featureValue;
        }

        $previousFeatureLookup = [];
        foreach ($previousFeatureValues as $featureValue) {
            $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

            if ($normalizedFeatureValue !== '') {
                $previousFeatureLookup[$normalizedFeatureValue] = true;
            }
        }

        $differentialFeatureValues = array_values(array_filter($deduplicatedCurrentValues, function ($featureValue) use ($previousFeatureLookup) {
            $normalizedFeatureValue = $this->normalizeComparisonValue($featureValue);

            return $normalizedFeatureValue !== '' && !array_key_exists($normalizedFeatureValue, $previousFeatureLookup);
        }));

        if (!empty($differentialFeatureValues) && !empty($previousProductTitle)) {
            return array_merge([
                [
                    'type' => 'inherited',
                    'label' => 'Everything in %s and more',
                    'context' => $previousProductTitle,
                ],
            ], array_map(static fn ($featureValue) => [
                'type' => 'feature',
                'label' => $featureValue,
            ], $differentialFeatureValues));
        }

        return array_map(static fn ($featureValue) => [
            'type' => 'feature',
            'label' => $featureValue,
        ], $deduplicatedCurrentValues);
    }
}
